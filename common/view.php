<?php 

require_once(SMARTY_DIR . "Smarty.class.php");

/**
 * Render page and save template variables
 */
class View extends Smarty {
	
	/**
	 * View class constructor
	 */
	public function __construct () {
		//Personalize smarty config
		$this->setconfig();
		
		//Check if flash messages set and send info to tpl
		$this->flashmessage();
						
		//Send config details
		$this->assign('URL', URL);
		$this->assign('URL_STATIC', URL_STATIC);
		$this->assign('URL_HOST', URL_HOST);
		$this->assign('URL_PREFIX', URL_PREFIX);
	
		//Send user details
		$user = User::get_instance();
		$this->assign('user', $user->get_all_info());
	}
	
	/**
	 * Check if a flash message is set
	 */
	private function flashmessage () {
		
		//Set value for flash var to reflect if a flash message exists
		$this->assign('flash', isset($_SESSION['_flash']));
		
		if (isset($_SESSION['_flash'])) {
			
			$flash['type'] = $_SESSION['_flash_type'];
			$flash['message'] = $_SESSION['_flash_message'];
			
			//Send message text to template
			$this->assign('flash', $flash);

			//Clear flash
			unset($_SESSION['_flash']);
			unset($_SESSION['_flash_type']);
			unset($_SESSION['_flash_message']);
		}
	}
	
	/**
	 * Configure Smarty
	 */
	private function setconfig () {
		/**
		 * The name of the directory where templates are located.
		 *
		 * @string
		 */
		$this->template_dir = VIEWS_DIR;
		
		/**
		 * The directory where compiled templates are located.
		 *
		 * @string
		 */
		$this->compile_dir = COMPILE_DIR;
		
		/**
		 * The directory where config files are located.
		 *
		 * @string
		 */
		$this->config_dir = 'configs';
		
		/**
		 * An array of directories searched for plugins.
		 *
		 * @array
		 */
		$this->plugins_dir = array('plugins');
		
		/**
		 * If debugging is enabled, a debug console window will display
		 * when the page loads (make sure your browser allows unrequested
		 * popup windows)
		 *
		 * @boolean
		 */
		$this->debugging = false;
		
		/**
		 * When set, smarty does uses this value as error_reporting-level.
		 *
		 * @boolean
		 */
		$this->error_reporting = null;
		
		/**
		 * This is the path to the debug console template. If not set,
		 * the default one will be used.
		 *
		 * @string
		 */
		$this->debug_tpl = '';
		
		/**
		 * This determines if debugging is enable-able from the browser.
		 * <ul>
		 *<li>NONE => no debugging control allowed</li>
		 *<li>URL => enable debugging when SMARTY_DEBUG is found in the URL.</li>
		 * </ul>
		 * @link http://www.foo.dom/index.php?SMARTY_DEBUG
		 * @string
		 */
		$this->debugging_ctrl = 'NONE';
		
		/**
		 * This tells Smarty whether to check for recompiling or not. Recompiling
		 * does not need to happen unless a template or config file is changed.
		 * Typically you enable this during development, and disable for
		 * production.
		 *
		 * @boolean
		 */
		$this->compile_check = true;
		
		/**
		 * This forces templates to compile every time. Useful for development
		 * or debugging.
		 *
		 * @boolean
		 */
		$this->force_compile = false;
		
		/**
		 * This enables template caching.
		 * <ul>
		 *<li>0 = no caching</li>
		 *<li>1 = use class cache_lifetime value</li>
		 *<li>2 = use cache_lifetime in cache file</li>
		 * </ul>
		 * @integer
		 */
		$this->caching = 0;
		
		/**
		 * The name of the directory for cache files.
		 *
		 * @string
		 */
		$this->cache_dir = CACHE_DIR;
		
		/**
		 * This is the number of seconds cached content will persist.
		 * <ul>
		 *<li>0 = always regenerate cache</li>
		 *<li>-1 = never expires</li>
		 * </ul>
		 *
		 * @integer
		 */
		$this->cache_lifetime = 3600;
		
		/**
		 * Only used when $this->caching is enabled. If true, then If-Modified-Since headers
		 * are respected with cached content, and appropriate HTTP headers are sent.
		 * This way repeated hits to a cached page do not send the entire page to the
		 * client every time.
		 *
		 * @boolean
		 */
		$this->cache_modified_check = false;
		
		/**
		 * This determines how Smarty handles "<?php ... ?>" tags in templates.
		 * possible values:
		 * <ul>
		 *<li>SMARTY_PHP_PASSTHRU -> print tags as plain text</li>
		 *<li>SMARTY_PHP_QUOTE-> escape tags as entities</li>
		 *<li>SMARTY_PHP_REMOVE -> remove php tags</li>
		 *<li>SMARTY_PHP_ALLOW-> execute php tags</li>
		 * </ul>
		 *
		 * @integer
		 */
		$this->php_handling = SMARTY_PHP_PASSTHRU;
		
		/**
		 * This enables template security. When enabled, many things are restricted
		 * in the templates that normally would go unchecked. This is useful when
		 * untrusted parties are editing templates and you want a reasonable level
		 * of security. (no direct execution of PHP in templates for example)
		 *
		 * @boolean
		 */
		$this->security = false;
		
		/**
		 * This is the list of template directories that are considered secure. This
		 * is used only if {@link $this->security} is enabled. One directory per array
		 * element.{@link $this->template_dir} is in this list implicitly.
		 *
		 * @array
		 */
		$this->secure_dir = array();
			
		/**
		 * These are the security settings for Smarty. They are used only when
		 * {@link $this->security} is enabled.
		 *
		 * @array
		 */
		$this->security_settings = array(
			'PHP_HANDLING'=> false,
			'IF_FUNCS'=> array( 'array', 'list',
								'isset', 'empty',
								'count', 'sizeof',
								'in_array', 'is_array',
								'true', 'false', 'null'),
			'INCLUDE_ANY' => false,
			'PHP_TAGS'=> false,
			'MODIFIER_FUNCS'=> array('count'),
			'ALLOW_CONSTANTS'=> false
		 );
		 
			/**
		 * This is an array of directories where trusted php scripts reside.
		 * {@link $this->security} is disabled during their inclusion/execution.
		 *
		 * @array
		 */
		$this->trusted_dir = array();
		
		/**
		 * The left delimiter used for the template tags.
		 *
		 * @string
		 */
		$this->left_delimiter ='{';
		
		/**
		 * The right delimiter used for the template tags.
		 *
		 * @string
		 */
		$this->right_delimiter ='}';
		
		/**
		 * The order in which request variables are registered, similar to
		 * variables_order in php.ini E = Environment, G = GET, P = POST,
		 * C = Cookies, S = Server
		 *
		 * @string
		 */
		$this->request_vars_order = 'EGPCS';
		
		/**
		 * Indicates wether $this->HTTP_*_VARS[] (request_use_auto_globals=false)
		 * are uses as request-vars or $this->_*[]-vars. note: if
		 * request_use_auto_globals is true, then $this->request_vars_order has
		 * no effect, but the php-ini-value "gpc_order"
		 *
		 * @boolean
		 */
		$this->request_use_auto_globals = true;
		
		/**
		 * Set this if you want different sets of compiled files for the same
		 * templates. This is useful for things like different languages.
		 * Instead of creating separate sets of templates per language, you
		 * set different compile_ids like 'en' and 'de'.
		 *
		 * @string
		 */
		$this->compile_id = null;
		
		/**
		 * This tells Smarty whether or not to use sub dirs in the cache/ and
		 * templates_c/ directories. sub directories better organized, but
		 * may not work well with PHP safe mode enabled.
		 *
		 * @boolean
		 *
		 */
		$this->use_sub_dirs = true;
		
		/**
		 * This is a list of the modifiers to apply to all template variables.
		 * Put each modifier in a separate array element in the order you want
		 * them applied. example: <code>array('escape:"htmlall"');</code>
		 *
		 * @array
		 */
		$this->default_modifiers = array();
		
		/**
		 * This is the resource type to be used when not specified
		 * at the beginning of the resource path. examples:
		 * $this->smarty->display('file:index.tpl');
		 * $this->smarty->display('db:index.tpl');
		 * $this->smarty->display('index.tpl'); // will use default resource type
		 * {include file="file:index.tpl"}
		 * {include file="db:index.tpl"}
		 * {include file="index.tpl"} {* will use default resource type *}
		 *
		 * @array
		 */
		$this->default_resource_type = 'file';
		
		/**
		 * The function used for cache file handling. If not set, built-in caching is used.
		 *
		 * @null|string function name
		 */
		$this->cache_handler_func = null;
		
		/**
		 * This indicates which filters are automatically loaded into Smarty.
		 *
		 * @array array of filter names
		 */
		$this->autoload_filters = array();
		
		/**#@+
		 * @boolean
		 */
		/**
		 * This tells if config file vars of the same name overwrite each other or not.
		 * if disabled, same name variables are accumulated in an array.
		 */
		$this->config_overwrite = true;
		
		/**
		 * This tells whether or not to automatically booleanize config file variables.
		 * If enabled, then the strings "on", "true", and "yes" are treated as boolean
		 * true, and "off", "false" and "no" are treated as boolean false.
		 */
		$this->config_booleanize = true;
		
		/**
		 * This tells whether hidden sections [.foobar] are readable from the
		 * tempalates or not. Normally you would never allow this since that is
		 * the point behind hidden sections: the application can access them, but
		 * the templates cannot.
		 */
		$this->config_read_hidden = false;
		
		/**
		 * This tells whether or not automatically fix newlines in config files.
		 * It basically converts \r (mac) or \r\n (dos) to \n
		 */
		$this->config_fix_newlines = true;
		
		/**
		 * If a template cannot be found, this PHP function will be executed.
		 * Useful for creating templates on-the-fly or other special action.
		 *
		 * @string function name
		 */
		$this->default_template_handler_func = '';
		
		/**
		 * The file that contains the compiler class. This can a full
		 * pathname, or relative to the php_include path.
		 *
		 * @string
		 */
		$this->compiler_file ='Smarty_Compiler.class.php';
		
		/**
		 * The class used for compiling templates.
		 *
		 * @string
		 */
		$this->compiler_class = 'Smarty_Compiler';
		
		/**
		 * The class used to load config vars.
		 *
		 * @string
		 */
		$this->config_class = 'Config_File';
	}
}

?>
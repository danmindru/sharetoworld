<?php

class FrontController {

    protected $_controller, $_action, $_params, $_body;
	
	/**
	 * FrontController instance
	 *
	 * @var FrontController
	 */
    protected static $_instance;

	/**
	 * Return FrontController instance
	 * If not exisst reate one
	 *
	 * @return FrontController
	 */
    public static function get_instance() {
        if ( ! (self::$_instance instanceof self) ) {
            self::$_instance = new self();
        }        
        return self::$_instance;
    }

	/**
	 * FrontController class constructor
	 * 
	 * @return FrontController
	 */
    protected function __construct() {
        $request = substr($_SERVER['REQUEST_URI'], strlen(URL_PREFIX));

        $splits = explode('/', trim($request, '/'));
        $this->_controller = !empty($splits[0]) ? $splits[0] : 'index';
        $this->_action = !empty($splits[1]) ? $splits[1] : 'index';
        
        if (!empty($splits[2])) {
            $keys = $values = array();
            
            for ($i=2, $cnt=count($splits); $i<$cnt; $i++) {
                if ($i % 2 == 0) {
                    //Is even, is key
                    $keys[] = $splits[$i];
                } else {
                    //Is oddm is value
                    $values[] = $splits[$i];
                } 
            }
            
            if (count($keys) != count($values)) {
				flash_error('Wrong URL parameters');
            } else {        
   	        	$this->_params = array_combine($keys, $values);
            }
        }
    }

	/**
	 * Create controller instance and invoke method 
	 */
    public function route() {
    	try {
			// Check if class exist
			// If not try to load file with controller name from controllers folder 
			if (!class_exists($this->getController()))
			{
				$path = ROOT_DIR . "controllers/" . $this->getController() . ".php";
				
				if (file_exists($path)) {
					require_once($path);
				} else {
					throw new Exception('Controller file not found');
				}
			}
		
			// Check if class exist and can be instantiated
	        if (class_exists($this->getController())) {
	            $rc = new ReflectionClass($this->getController());
	            
				// Check if class implements IController interface
	            if ($rc->ImplementsInterface('IController')) {
				
					// Check if class has action specified method 
					// Invoke method
	                if ($rc->hasMethod($this->getAction())) {
	                    $controller = $rc->newInstance();
	                    $method = $rc->getMethod($this->getAction());
	                    $method->invoke($controller);
	                } else {
	                    throw new Exception("Action not found");
	                }
	            } else {
	            	throw new Exception('Controller does not implements IController'); 
	            }
	        } else {
	        	throw new Exception('Controller not found');  
	        }
    	} catch (Exception $e) {
    		//Display an error message
			flash_error('Page not found');
			redirect();
    	}
    }

	/**
	 * Return request params
	 *
	 * @return string
	 */
    public function getParams() {
        return $this->_params;
    }

	/**
	 * Return controller name
	 *
	 * @return string
	 */
    public function getController() {
        return $this->_controller;
    }

	/**
	 * Return controller method
	 *
	 * @return string
	 */
    public function getAction() {
        return $this->_action;
    }

	/**
	 * Return page body
	 *
	 * @return string
	 */
    public function getBody() {
        return $this->_body;
    }

	/**
	 * Set page body
	 *
	 * @param string $body
	 */
    public function setBody($body) {
        $this->_body = $body;
    }
}
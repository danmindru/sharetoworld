<?php
define('ROOT_DIR', 'D:\Projects\Sites\Share To World GitHUB\\');
define('DATA_DIR', ROOT_DIR . 'data/');
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'share_to_world');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_KEEP_ALIVE', false);
define('URL_HOST', 'localhost');
define('URL_PREFIX', '/stw/');
define('SENDER_EMAIL', '');
define('COMPILE_DIR', DATA_DIR . 'compile');
define('CACHE_DIR', DATA_DIR . 'cache');
define('CACHE_COMPILE_USE_SUBDIRS', true);
define('CONTROLLERS_DIR', ROOT_DIR . 'controllers/');
define('VIEWS_DIR', ROOT_DIR . 'views/');
define('COMMON_DIR', ROOT_DIR . 'common/');
define('STATIC_DIR', ROOT_DIR . 'static/');
define('DB_DIR', ROOT_DIR . 'common/db/');
define('FUNCTIONS_DIR', ROOT_DIR . 'common/functions/');
define('UTIL_DIR', ROOT_DIR . 'common/util/');
define('SMARTY_DIR', ROOT_DIR . 'common/smarty/');
define('DEVELOPEMENT_MODE', true);
define('DEBUG_MODE', '1');
define('PROTOCOL', 'http://');
define('URL', PROTOCOL . URL_HOST . URL_PREFIX);
define('URL_STATIC', PROTOCOL . URL_HOST . URL_PREFIX . 'static/');
define('COOKIE_DOMAIN', null);
define('SESSION_LIFETIME_SECONDS', 5*24*3600);
?>
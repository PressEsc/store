<?php
// HTTP
define('HTTP_SERVER', 'http://store/');

// HTTPS
define('HTTPS_SERVER', 'http://store/');

// DIR
define('DIR_APPLICATION', '/Users/Null/Developer/store/catalog/');
define('DIR_SYSTEM', '/Users/Null/Developer/store/system/');
define('DIR_IMAGE', '/Users/Null/Developer/store/image/');
define('DIR_STORAGE', '/Users/Null/Developer/storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '0086');
define('DB_DATABASE', 'opencart');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
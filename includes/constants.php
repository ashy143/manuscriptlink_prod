<?php

// define('HOST_URL', 'http://tundra.csd.sc.edu/manuscriptlink_prod');
define('HOST_URL', 'http://localhost/manuscriptlink_prod');
define('WEBMAIL_ID', 'admin@manuscriptlink.com');
DEFINE('HTTP_TYPE', 'http');
DEFINE('HTTP_ROOT', $_SERVER['HTTP_HOST']);
DEFINE('HTTP_FOLDER', dirname($_SERVER['PHP_SELF']) . '/');
DEFINE('BASE_URL', HTTP_TYPE . "://" . HTTP_ROOT . HTTP_FOLDER);
DEFINE('MD5_KEY', 'a1s2h3y4');

?>
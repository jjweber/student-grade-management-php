<?php
$config = array(
'defaultController' => 'Index',
'dbname' => 'grades',
'dbpass' => '',
'dbuser' => 'root',
'baseurl' => 'localhost:8080'
);
$str=$config["baseurl"]."/".$_SERVER['REQUEST_URI'];
$urlPathParts = explode('/', ltrim(parse_url($str, PHP_URL_PATH), '/'));

include 'route.php';
$route = new router($urlPathParts, $config);
?>
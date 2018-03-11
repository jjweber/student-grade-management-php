<?php
include 'bin/app.php';
class Router{
    public function __construct($urlPathParts, $config){
        $this->App = new App($config);
        $this->App->startApp($urlPathParts);
    }
}
?>
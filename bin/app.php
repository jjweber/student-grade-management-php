<?php
include 'appcontroller.php';
class App{
    public function __construct($config){
        $this->config = $config;
    }
    public function startApp($prams){
        $AppController = new AppController($prams, $this->config);
    }
}
?>
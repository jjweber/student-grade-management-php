<?php
session_start();
class AppController{
    public function __construct($urlPathParts, $config){

        try {
            $this->db = new PDO("mysql:dbname=".$config["dbname"].";", $config["dbuser"], $config["dbpass"]);
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND)."<br>";
            die();
        }
        $this->urlPathParts = $urlPathParts;
        if ($urlPathParts[2]) {           
            include './controllers/'.$urlPathParts[2].".php";
            $appcon = new $urlPathParts[2]($this);
            //var_dump($appcon);
            if (isset($urlPathParts[3])) {              
                $actionName = $urlPathParts[3];

                if(isset($urlPathParts[4])) {
                    $appcon->{$actionName} ($urlPathParts[4]);
                } else {
                    $appcon->{$actionName} ();
                }

            } else {
                $methodVariable = array($appcon, 'index');
                if (is_callable($methodVariable, false, $callable_name)) {
                    $appcon->index($this);
                }
            }
        } else {
            include './controllers/'.$config["defaultController"].".php";
            $appcon = new $config['defaultController']($this);
            // var_dump($appcon);
            if (isset($urlPathParts[0])) {
                $appcon->config['defaultController'][0]();
            } else {
                $methodVariable = array($appcon, 'index');
                
                if (is_callable($methodVariable, false, $callable_name)) {
                    $appcon->index($this);
                }
            }
        }
    }
    
    public function getView($folder, $page, $data=array(), $data2=array()) {
        
        require_once './views/'. $folder.'/'.$page.".phtml";
    }
    public function getModel($page) {
        require_once './models/'.$page.".php";
        $model = new $page($this);
        return $model;
        
    }
}
?>
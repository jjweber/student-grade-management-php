<?php
    require_once 'libs/Controller.php';

    class Error extends Controller
    {
        public function IndexAction()
        {
            $this->view->message = "The controller doesn't exist!";
            $this->view->render('views/error/index.phtml');
        }
    }

?>
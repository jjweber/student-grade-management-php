<?php

    class Delete extends AppController
    {
        public function __construct($parent)
        {
            $this->parent = $parent;
        }

        public function index()
        {
            $studentid = $_GET['studentid'];
            $data = $this->parent->getModel("students")->select("select * from students WHERE studentid = :studentid", array(":studentid"=> $studentid));
            $this->getView('delete', 'delete', $data);
        }

        public function removeAction()
        {
            $studentid = $_REQUEST['studentid'];
            $this->parent->getModel("students")->delete("DELETE FROM students WHERE studentid = :studentid", array(":studentid"=> $studentid));
            header("Location: /studentGrade_ManagementApp/index.php/Index");
        }
    }

?>
<?php

    class Read extends AppController
    {
        public function __construct($parent)
        {
            $this->parent = $parent;
        }

        public function index()
        {
            $studentid= $_GET['studentid'];
            $data = $this->parent->getModel("students")->select("select * from students WHERE studentid = :studentid", array(":studentid"=> $studentid));
            $this->getView('read', 'read', $data);
        }
    }

?>
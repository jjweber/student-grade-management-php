<?php

    class Index extends AppController
    {
        public function __construct($parent)
        {
            $this->parent = $parent;
        }

        public function index()
        {
            $data = $this->parent->getModel("students")->select("select * from students");
            $this->getView('home', 'index', $data);
        }
    }

?>
<?php
    class Update extends AppController
    {
        public function __construct($parent)
        {
            $this->parent = $parent;
        }

        public function index()
        {            
            $studentid= $_GET['studentid'];
            $data = $this->parent->getModel("students")->select("select * from students WHERE studentid = :studentid", array(":studentid"=> $studentid));
            $this->getView('update', 'update', $data);
        }

        public function updateAction()
        {
            $studentid = $_REQUEST['studentid'];

            // keep track validation errors
            $nameError = null;
            $percentError = null;
            $letterGradeError = null;

            // keep track post values
            $name = $_REQUEST['studentname'];
            $percent = $_REQUEST['studentpercent'];
            $letterGrade = null;

            $getTotal = null;
            $outputLetterGrade = null;

            function convertToLetter($getTotal) {
                if($getTotal >= 90) {
                    $outputLetterGrade = 'A';
                } 
                elseif($getTotal >= 80) {
                    $outputLetterGrade = 'B';
                }
                elseif($getTotal >= 70) {
                    $outputLetterGrade = 'C';
                }
                elseif($getTotal >= 60) {
                    $outputLetterGrade = 'D';
                } else {
                    $outputLetterGrade = 'F';
                }

                return $outputLetterGrade;
            }


            $letterGrade = convertToLetter($percent); // call the function

            // validate input
            $valid = true;
            if (empty($name)) {
                $nameError = 'Please enter Students Name';
                $valid = false;
            }

            if (empty($percent)) {
                $percentError = 'Please enter Students percent';
                $valid = false;
            } 

            // update data
            if ($valid) {
                if ($valid) {
                    $this->parent->getModel("students")->update("UPDATE students SET studentname = :studentname, studentpercent = :studentpercent, studentlettergrade = :studentlettergrade WHERE studentid= :studentid", array(":studentname"=> $name, ":studentpercent"=> $percent, ":studentlettergrade"=> $letterGrade, ":studentid"=> $studentid));
                    header("Location: /studentGrade_ManagementApp/index.php/Index");
                } else {
                    header("Location: /studentGrade_ManagementApp/index.php/Update?nameError=$nameError&percentError=$percentError");
                }
            }
                
            
        }
    }
?>
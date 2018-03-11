<?php
    
    class Create extends AppController
    {
        public function __construct($parent)
        {
            $this->parent = $parent;
        }

        public function index()
        {
            
            $this->getView('create', 'create');
        }
        public function addAction()
        {

            if ( !empty($_POST)) {
                // keep track validation errors
                $nameError = null;
                $percentError = null;
                $letterGradeError = null;
                 
                // keep track post values
                $name = $_POST['studentname'];
                $percent = $_POST['studentpercent'];
                
                // letter grade variables
                $letterGrade = null;
                $getTotal = null;
                $outputLetterGrade = null;
        
                // function to convert passed grade to letter grade
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
                
                // call the function and pass percentage then setting value to lettergrade variable
                $letterGrade = convertToLetter($percent); 
        
                // validate inputs
                $valid = true;
                if ($name === '') {
                    $nameError = 'Please enter Students Name';
                    $valid = false;
                }
                 
                if ($percent === '') {
                    $percentError = 'Please enter Students percent';
                    $valid = false;
                } 
               
                // insert data if inputs are valid
                if ($valid) {
                    $this->parent->getModel("students")->add("INSERT INTO students (studentname, studentpercent, studentlettergrade) values(?, ?, ?)", array($name,$percent,$letterGrade));
                    header("Location: /studentGrade_ManagementApp/index.php/Index");
                } else {
                    header("Location: /studentGrade_ManagementApp/index.php/Create?nameError=$nameError&percentError=$percentError");
                }
            } 
            
        }
        
    }

?>
<?php
    class Employee {

        private $employee_id;
        private $employee_name;
        private $employee_work_start_date;

        public function __construct($emp_id, $emp_name, $start_date){
            $this->employee_id = $emp_id;
            $this->setEmpName($emp_name);
            $this->setEmpWorkStartDate($start_date); 

        }

        public function getEmpID(){
            return $this->employee_id;
        }

        public function getEmpName(){
            return $this->employee_name;
        }

        public function getEmpWorkStartDate(){
            return $this->employee_work_start_date;
        }

        public function setEmpName($name){
            $this->employee_name = $name;
        }

        public function setEmpWorkStartDate($date){
            if($date == ''){
                $this->employee_work_start_date = date("Y-m-d H:i:s");
            }
            else {
                $this->employee_work_start_date = $date;
            }
        }
            

    }





?>

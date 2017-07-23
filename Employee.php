<?php
    class Employee {

        private $employee_id;
        private $employee_name;
        private $employee_work_start_date;

        public function __construct($employee_id, $employee_name){
            $this->employee_id = $employee_id;
            $this->employee_name = $employee_name;
            $this->employee_work_start_date = date("Y-m-d H:i:s");

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


        public function setEmpName($employee_name){
            $this->employee_name = $employee_name;
        }

    }





?>

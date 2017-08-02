<?php

    require_once 'Connection.php';
    require_once 'Employee.php';

    if(isset($_POST["activity"])){
        $activity = $_POST["activity"];

        switch ($activity) {
            case "GetAllEmployees":
                GetAllEmployees();
                break;
            case "GetEmployee":
                GetEmployee();
                break;
            case "AddEmployee":
                AddEmployee();
                break;
            case "UpdateEmployee":
                UpdateEmployee();
                break;
            case "DeleteEmployee":
                DeleteEmployee();
                break;
            default:
                echo "activity requested unknown";    
        }
    }
    else {
      echo "no button clicked"; 
    }

    function GetAllEmployees(){
        echo '<h3>List of all Employees</h3>';
        $con = new Connection('northwind');
        DisplayAllEmployees($con);
    }

    function GetEmployee(){

        $empID = $_POST["employeeID"];
        if($empID == '') //testing isset($_POST["employeeID"]) meaningless -> it is always true
        {
            echo 'Action Requested Get Employee: Please enter employee id';
            return;
        }

        $con = new Connection('northwind');
        $Parms = ['emp_id' => $empID]; 
        $stmt = $con->executeStatement('SELECT * FROM employee WHERE employee_id = :emp_id', $Parms);

        if ($row = $stmt->fetch())
        {
            echo 'employee_id = ' . $row['employee_id'] . "<br>";
            echo 'employee_name ' . $row['employee_name'] . "<br>";
            echo 'employee_work_start_date ' . $row['employee_work_start_date'];
        }
        else {
              echo "No employee with employee_id $empID found";
        }
    }

    function AddEmployee(){
        if(trim($_POST["employeeName"] == ''))  //testing isset($_POST["employeeID"]) meaningless -> it is always true
        {
            echo 'Action Requested Add Employee: Please enter employee name';
            return;
        }

        $Employee = new Employee(0, $_POST["employeeName"], $_POST["employeeWorkStartDate"]);

        $con = new Connection('northwind');
        $Parms = ["emp_name" => $Employee -> getEmpName(), 
                  "emp_start_date" => $Employee -> getEmpWorkStartDate()]; 
        $stmt = $con->executeStatement('SELECT * FROM employee WHERE employee_name = :emp_name AND employee_work_start_date= :emp_start_date ', $Parms);
        if ($stmt->rowCount() > 0) {
           echo "Employee with same employee_name (" . $Employee->getEmpName() . ") and same employee_work_start_date (" . $Employee->getEmpWorkStartDate() . ") found! Cannot be added!";   
        }
        else {
            $con = new Connection('northwind');
            $Parms = ["emp_name" => $Employee -> getEmpName(), 
                    "emp_work_start_date" => $Employee -> getEmpWorkStartDate()]; 
            $stmt = $con->executeStatement("insert into employee (employee_name,
                                                        employee_work_start_date)
                                            values  (:emp_name,
                                                    :emp_work_start_date)", $Parms);
            echo 'new employee added successfully';
        }
        
        echo '<h3>List of all Employees</h3>';
        DisplayAllEmployees($con);           
    }

    function UpdateEmployee(){
        //testing isset($_POST["employeeID"]) meaningless -> it is always true
        $empID = $_POST["employeeID"];
        if($empID == '')  
        {
            echo 'Action Requested Update Employee: Please enter employee id';
            return;
        }

        $con = new Connection('northwind');
        $Parms = ['emp_id' => $empID]; 
        $stmt = $con->executeStatement('SELECT * FROM employee WHERE employee_id = :emp_id', $Parms);

        if ($row = $stmt->fetch())
        {
            $Employee = new Employee($row['employee_id'], $row['employee_name'], $row['employee_work_start_date']);
            $EmpName = trim($_POST["employeeName"]) == '' ? $Employee -> getEmpName() : trim($_POST["employeeName"]);
            $EmpStartDate = $_POST["employeeWorkStartDate"] == '' ? $Employee -> getEmpWorkStartDate() : $_POST["employeeWorkStartDate"];

            $Parms = ["emp_id" => $Employee -> getEmpID(), 
                      "emp_name" => $EmpName, 
                      "emp_start_date" => $EmpStartDate]; 
            $stmt = $con->executeStatement("update employee set employee_name = :emp_name, employee_work_start_date = :emp_start_date where employee_id = :emp_id", $Parms);

            echo 'employee updated successfully'; 
        }
        else {
              echo "No employee with employee_id $empID found";
        }

        echo '<h3>List of all Employees</h3>';
        DisplayAllEmployees($con);           
    }

    function DeleteEmployee(){

        $empID = $_POST["employeeID"];
        if($empID == '')  //testing isset($_POST["employeeID"]) meaningless -> it is always true
        {
            echo 'Action Requested Delete Employee: Please enter employee id';
            return;
        }

        $con = new Connection('northwind');
        $Parms = ['emp_id' => $empID]; 
        $stmt = $con->executeStatement("delete from employee where employee_id = :emp_id", $Parms);
        if ($stmt->rowCount() == 0) {
           echo "no employee with employee_id $empID found - below list of all employees <br>";            
        }
        else{
           echo 'delete successful - below list of remaining employees <br>';            
        }

        echo '<h3>List of all Employees</h3>';
        DisplayAllEmployees($con);        
    }

    function DisplayAllEmployees($con){
        //select statement has no parameters for sql statement -> must send empty parms: executeStatement is general function that executes 
        //sql statement with and without parameters
        $emptyParms = []; 
        $stmt = $con->executeStatement('SELECT * FROM employee order by employee_id', $emptyParms);

        if($stmt->rowCount() == 0){
            echo "no employees found - table empty";
            return;
        }

        while ($row = $stmt->fetch())
        {
            echo 'employee_id = ' . $row['employee_id'] . "<br>";
            echo 'employee_name ' . $row['employee_name'] . "<br>";
            echo 'employee_work_start_date ' . $row['employee_work_start_date'] . "<br><br><br>";
        }
    }

?>
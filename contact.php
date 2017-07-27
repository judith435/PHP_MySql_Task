<?php

    require_once 'Employee.php';
    require_once 'configDb.php';

    if(isset($_POST["activity"])){
        $activity = $_POST["activity"];

        switch ($activity) {
            case "AllEmployees":
                AllEmployees();
                break;
            case "GetEmployee":
                GetEmployee();
                break;
            case "NewEmployee":
                NewEmployee();
                break;
            case "DeleteEmployee":
                DeleteEmployee();
        }
    }
    else {
      echo "no button clicked"; 
    }

    function AllEmployees(){
        $pdo = get_PDO();

        $stmt = $pdo->prepare('SELECT * FROM employee order by  employee_id' );
        $stmt->execute();
        if($stmt->rowCount() == 0){
            echo "no employees found";
            return;
        }

        while ($row = $stmt->fetch())
        {
            echo 'employee_id = ' . $row['employee_id'] . "<br>";
            echo 'employee_name ' . $row['employee_name'] . "<br>";
            echo 'employee_work_start_date ' . $row['employee_work_start_date'] . "<br><br><br>";
        }
    }

    function GetEmployee(){
        if($_POST["employeeID"] == '')
        {
            echo 'please enter employee id';
            return;
        }
        $Employee = new Employee($_POST["employeeID"], "","");

        $pdo = get_PDO();

        $stmt = $pdo->prepare('SELECT * FROM employee WHERE employee_id = :employee_id' );
        $stmt->execute(['employee_id' => $Employee->getEmpID()]);
        if ($row = $stmt->fetch())
        {
            echo 'employee_id = ' . $row['employee_id'] . "\n";
            echo 'employee_name ' . $row['employee_name'] . "\n";
            echo 'employee_work_start_date ' . $row['employee_work_start_date'] . "\n";
        }
        else{
              echo "no employee found";

        }
    }

    function NewEmployee(){
        if($_POST["employeeName"] == '')
        {
            echo 'please enter employee name';
            return;
        }

        $Employee = new Employee(0, $_POST["employeeName"], $_POST["employeeWorkStartDate"]);

        $pdo = get_PDO();
        $stmt = $pdo->prepare("insert into employee (employee_name,
                                                     employee_work_start_date)
                                    values  (:employee_name,
                                             :employee_work_start_date)");

                $stmt ->execute(array("employee_name" => $Employee -> getEmpName(), 
                                      "employee_work_start_date" => $Employee -> getEmpWorkStartDate(), 
                    ));
        echo 'insert successful';            
    }

    function DeleteEmployee(){
        if($_POST["employeeID"] == '')
        {
            echo 'please enter employee id';
            return;
        }

        $pdo = get_PDO();

        $stmt = $pdo->prepare('delete from employee where employee_id = :employee_id' );
        $stmt->execute(['employee_id' => $_POST["employeeID"]]);

        echo 'delete successful - below list of remaining employees <br>';            
        $stmt = $pdo->prepare('SELECT * FROM employee order by  employee_id' );
        $stmt->execute();
        while ($row = $stmt->fetch())
        {
            echo 'employee_id = ' . $row['employee_id'] . "<br>";
            echo 'employee_name ' . $row['employee_name'] . "<br>";
            echo 'employee_work_start_date ' . $row['employee_work_start_date'] . "<br><br><br>";
        }
    }

    function get_PDO(){
        $pdo_parms = ConfigDB::build_pdo_parms('northwind');
        return new PDO($pdo_parms['dsn'], $pdo_parms['user'], $pdo_parms['pass'],  $pdo_parms['opt']);
    }


?>
<?php

    require_once 'PDO_Parms.php';

    class ConfigDB {

        public static function build_pdo_parms($db) {
            $pdo_Parms = PDO_Parms::get_pdo_parms();
            $pdo_Parms['dsn'] = "mysql:host=" . $pdo_Parms['host'] . ";dbname=" . $db . ";charset=" .  $pdo_Parms['charset'];
            return $pdo_Parms;
        }

}




?>
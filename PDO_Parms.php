   <?php

       class PDO_Parms {

        private static $pdo_parms = [
                    "host" => '127.0.0.1',
                    "user" => 'root',
                    "pass" => '',
                    "charset" => 'utf8',
                    "dsn" => '',
                    "opt" => [
                                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                PDO::ATTR_EMULATE_PREPARES   => false,
                    ] 
                ];
        

        public static function get_pdo_parms() {
            return self::$pdo_parms;
        }


}
?>   

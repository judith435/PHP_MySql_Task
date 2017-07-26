<?php
    class ConfigDB {

        private $user = 'root';
        private $pass = '';
        private $opt = [
                            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            PDO::ATTR_EMULATE_PREPARES   => false,
                    ];

        public static function northwind() {
                $host = '127.0.0.1';
                $db='northwind';
            // $user = 'root';
            //  $pass = '';
                $charset = 'utf8';
                $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
                return $dsn;

        }

        public static function get_user(){
                return $this->user;
            }

        public static function get_pass(){
                return $this->pass;
            }

        public static function get_opt(){
                return $this->opt;
            }
}




?>
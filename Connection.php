<?php

    class Connection {

        private $host = '127.0.0.1';
        private $db;
        private $user = 'root';
        private $pass = '';
        private $charset = 'utf8';
        private $dsn;
        private $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
       
        public function __construct($db) {
            $this->setDB($db);
            $this->dsn = "mysql:host=$this->host;dbname=" . $this->getDB() . ";charset=$this->charset";
        }

        //function should be private so that outside hackers cannot get datatbase info
        private function getDB(){
            return $this->db;
        }

        //function should be private so that outside hackers cannot change datatbase access
        private function setDB($db){
            $this->db = $db;
        }

        public function executeStatement($query, $parms) {
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
            $stmt = $pdo->prepare($query);
            $stmt->execute($parms);
            return $stmt;
        }
    }

?>

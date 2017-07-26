<?php
    class Connection {

        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset;
        private $dsn;
        private $opt;

        public function __construct($db){
            $this->host = '127.0.0.1';
            $this->db   = $db;//'northwind';
            $this->user = 'root';
            $this->pass = '';
            $this->charset = 'utf8';
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $this->opt = [
                            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            PDO::ATTR_EMULATE_PREPARES   => false,

            ];

        }

        function getConnection(){
            return new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        }



    }

?>

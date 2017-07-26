<?php
    public static class Connection {

        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset;
        private $dsn;
        private $opt;

        public function __construct($db){
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

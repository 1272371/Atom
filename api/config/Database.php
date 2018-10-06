<?php

    class Database {

        // database parameters
        private $host = 'localhost';
        private $name = 'risk';
        //private $user = 's815108';
        private $user ="root";
        //private $pass = 'random123';
        private $pass = "";
        private $conn;

        /**
         * Database constructor.
         */
/**
     * @param string $host
     */
        public function setHost(string $host): void
        {
            $this->host = $host;
        }
        public function __construct(string $host , string $name, string $user, string $pass, $conn)
        {
            if($host!=""){
                $host=$this->setHost("localhost");
            }
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
            $this->conn = $conn;
        }
        /**
         * Database constructor.
         * @param string $host
         * @param string $name
         * @param string $user
         * @param string $pass
         * @param $conn
         */


        // connection function
        public function connect() {
            $this->conn = null;
            try {
                // uses php database object (PDO)
                $this->conn = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->name,
                    $this->user, $this->pass);
                // set attributes
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
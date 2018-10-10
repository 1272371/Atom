<?php

    class Database {

        // database parameters
        //private $host = 'localhost';
        //private $name = 'd815108';
        //private $user = 's815108';
        //private $pass = 'random123';
        private $conn;

        /**
         * uncomment to connect locally
         * then comment live variables
         */

        private $host = '127.0.0.1';
        private $name = 'risk';
        private $user = 'root';
        private $pass = '';

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
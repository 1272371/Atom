<?php

    class Database {

        // database parameters
        private $host = 'localhost';
        private $name = 'risk';
        private $user = 'root';
        private $pass = '';
        private $conn;

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
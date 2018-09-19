<?php

    class Database {

        private $host = 'localhost';
        private $name = 'risk';
        private $user = 'root';
        private $pass = '';
        private $connection;

        public function __constructor() {
            echo 'created';
        }

        public function connectDatabase() {

            $this->connection = null;

            try {

                $this->connection = new \PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->name,
                    $this->user, $this->pass);
                // enable exceptions
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {

                echo 'Connection Error: ' . $e->getMessage();

            }

            return $this->connection;
        }

    }
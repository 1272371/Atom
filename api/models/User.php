<?php

    class User {

        // database stuff
        private $conn;

        // properties
        public $ok;
        public $user_id;
        public $user_name;
        public $user_surname;
        public $user_password;
        public $user_yearofstudy;
        public $faculty_name;
        public $user_type;

        // user constructor
        public function __construct($db) {
            $this->conn = $db;
            $this->ok = false;
        }

        // get users
        public function get() {

            // create query
            $query = 'SELECT
                u.user_id,
                f.faculty_name as faculty_name,
                u.user_name,
                u.user_surname
                FROM
                user u
                LEFT JOIN
                faculty f
                ON
                u.faculty_id = f.faculty_id
                ORDER BY
                u.user_id ASC';

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            return $statement;
        }

        // get single user
        public function getUser() {

            $query = 'SELECT
                u.user_id,
                f.faculty_name as faculty_name,
                u.user_name,
                u.user_surname
                FROM
                user u
                LEFT JOIN
                faculty f
                ON
                u.faculty_id = f.faculty_id
                WHERE
                u.user_id = ?
                LIMIT 0, 1';

            // prepare query
            $statement = $this->conn->prepare($query);

            // bind id
            $statement->bindParam(1, $this->user_id);

            // execute query
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->user_id = $row['user_id'];
            $this->user_name = $row['user_name'];
            $this->user_surname = $row['user_surname'];
            $this->faculty_name = $row['faculty_name'];
        }

        public function getUsersByName() {

            $query = 'SELECT
                u.user_id,
                f.faculty_name as faculty_name,
                u.user_name,
                u.user_surname
                FROM
                user u
                LEFT JOIN
                faculty f
                ON
                u.faculty_id = f.faculty_id
                WHERE
                u.user_name LIKE ?
                ORDER BY
                u.user_id ASC';

            // prepare query
            $statement = $this->conn->prepare($query);

            // bind id
            $statement->bindParam(1, $this->user_name);

            // execute query
            $statement->execute();

            return $statement;
        }

        public function addUser(){
            $query = 'INSERT INTO user (user_id,user_name,user_surname,user_password,user_yearofstudy,faculty_name,user_type) ';
            $query = $query . 'VALUES (' . $this->user_id . ', "' . $this->user_name .
                '", "' . $this->user_surname . '", "' . $this->user_password  .'", ' . $this->user_yearofstudy .
                ', ' . $this->faculty_name . ', ' . $this->user_type . ')';

            try {

                // prepare statement
                $statement = $this->conn->prepare($query);
                // execute statement
                $this->ok = $statement->execute();

            } catch (PDOException $e) {
                $this->ok = false;
            }
        }

    }
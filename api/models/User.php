<?php

    class User {

        // database stuff
        private $conn;

        // properties
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
                u.user_id DESC';

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
            $this->user_name = $row['user_name'];
        }

    }
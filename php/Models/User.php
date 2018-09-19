<?php

    class User {

        // database variables
        private $conn;
        private $table = 'user';

        // user attributes
        public $user_id;
        public $user_type;
        public $user_name;
        public $user_surname;
        public $user_yearofstudy;
        public $faculty_name;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getUsers() {

            $query = 'select
                u.user_id,
                u.user_type,
                u.user_name,
                u.user_surname,
                u.user_yearofstudy,
                u.faculty_id,
                f.faculty_name as faculty_name 
                from
                ' . $this->table .' u
                left join
                faculty f on u.faculty_id = f.faculty_id
                order by
                u.user_id asc';

                $statement = $this->conn->prepare($query);
                $statement->execute();

                return $statement;
        }
        
    }
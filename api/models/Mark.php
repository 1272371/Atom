<?php

    class Mark {

        // database stuff
        private $conn;

        // properties
        public $user_id;
        public $user_name;
        public $user_surname;
        public $assessment_name;
        public $mark_total;
        public $course_name;

        // user constructor
        public function __construct($db) {
            $this->conn = $db;
        }

        // get users
        public function get() {

            // create query
            $query = 'SELECT
                m.user_id,
                u.user_name as user_name,
                u.user_surname as user_surname,
                a.assessment_name as assessment_name,
                m.mark_total,
                c.course_name as course_name
                from mark m
                left join assessment a
                on m.assessment_id=a.assessment_id
                left join user u
                on m.user_id=u.user_id
                left join course c
                on a.course_id=c.course_id;';

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            return $statement;
        }

    }
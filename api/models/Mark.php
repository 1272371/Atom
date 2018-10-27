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
        public $course_id;
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
                m.assessment_id,
                a.assessment_weight as assessment_weight,
                a.assessment_total as assessment_total,
                a.assessment_date as assessment_date,
                a.assessment_name as assessment_name,
                m.mark_total,
                a.course_id as course_id,
                c.course_name as course_name
                from mark m
                left join assessment a
                on m.assessment_id=a.assessment_id
                left join user u
                on m.user_id=u.user_id
                left join course c
                on a.course_id=c.course_id;
                ORDER BY
                m.user_id ASC';

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            return $statement;
        }
        // get array of marks for an assessment
        public function getMarksByAssessmentId($assessmentId) {

            // create query
            $query = 'SELECT mark_total from mark where assessment_id=';
            $query .= $assessmentId;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // row count
            $num = $statement->rowCount();

            if ($num > 0) {

                // index and array
                $i = 0;
                $data = array();

                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                    // put into array
                    $data[$i] = $row['mark_total'] + 0;
                    $i++;
                }
                return $data;
            }
            else {
                return 0;
            }
        }
        // get array of marks for an assessment
        public function getMarksByUserId($userId) {

            // create query
            $query = 'SELECT ROUND(AVG(mark_total)) as mark_total from mark where user_id=';
            $query .= $userId;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // row count
            $num = $statement->rowCount();

            if ($num > 0) {
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                return $row['mark_total'];
            }
            else {
                return 0;
            }
        }

    }
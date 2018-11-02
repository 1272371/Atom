<?php

    class Basic {

        // database stuff
        private $conn;

        // user properties
        public $user_id;
        public $user_name;
        public $user_surname;
        public $user_password;
        public $user_yearofstudy;
        public $faculty_name;
        public $user_type;

        // subject properties
        public $subject_name;
        public $subject_enrollmentyear;

        // course properties
        public $course_id;
        public $course_name;

        // lookup table properties
        public $user_type_lookup;
        public $assessment_info_lookup;
        public $assessment_medium_lookup;
        public $assessment_type_lookup;

        // user constructor
        public function __construct($db) {
            $this->conn = $db;
        }

        // get user registered subjects
        public function getSubjects() {

            $query = 'SELECT
                s.course_id,
                c.course_name as course_name
                FROM
                subject s
                LEFT JOIN
                course c
                ON
                s.course_id = c.course_id
                WHERE
                s.user_id = ?';

            // prepare query
            $statement = $this->conn->prepare($query);

            // bind id
            $statement->bindParam(1, $this->user_id);

            // execute query
            $statement->execute();

            return $statement;
        }
        public function getStudents() {

            $query = 'SELECT
                s.user_id
                FROM
                subject s
                WHERE
                s.course_id =' . $this->course_id . '
                AND
                s.subject_enrollmentyear =' . $this->subject_enrollmentyear;

            // prepare query
            $statement = $this->conn->prepare($query);
            
            // execute query
            $statement->execute();

            return $statement;
        }
        // get array of students
        // get all lookups
        public function getLookups() {

            // user type lookup - lecturer, student, etc
            $utl = 'SELECT * FROM user_type_lookup ORDER BY utl_id ASC';
            // assessment info lookup - main, deferred, supplementary
            $ail = 'SELECT * FROM assessment_info_lookup ORDER BY ail_id ASC';
            // assessment medium lookup - written, online, mcq, spoken
            $aml = 'SELECT * FROM assessment_medium_lookup ORDER BY aml_id ASC';
            // assessment type lookup - class, exam, assignment, project
            $atl = 'SELECT * FROM assessment_type_lookup ORDER BY atl_id ASC';

            // prepare statements
            $sutl = $this->conn->prepare($utl);
            $sail = $this->conn->prepare($ail);
            $saml = $this->conn->prepare($aml);
            $satl = $this->conn->prepare($atl);

            // execute statements
            $sutl->execute();
            $sail->execute();
            $saml->execute();
            $satl->execute();

            // set properties
            $this->user_type_lookup = $sutl;
            $this->assessment_info_lookup = $sail;
            $this->assessment_medium_lookup = $saml;
            $this->assessment_type_lookup = $satl;
        }

    }
<?php

    class Assessment {

        // database stuff
        private $conn;
        // properties
        public $ok;
        public $assessment_id;
        public $assessment_name;
        public $assessment_weight;
        public $assessment_total;
        public $assessment_date;
        public $ail_id;
        public $aml_id;
        public $atl_id;
        public $course_id;
        public $csv;

        // user constructor
        public function __construct($db) {
            $this->conn = $db;
            $this->ok = false;
        }

        // add assessment
        public function addAssessment() {

            // query for assessment table
            $query = 'INSERT INTO assessment (assessment_name,assessment_weight,assessment_total,assessment_date,ail_id,aml_id,atl_id,course_id) ';
            $query = $query . 'VALUES ("' . $this->assessment_name . '", ' . $this->assessment_weight .
            ', ' . $this->assessment_total . ', "' . $this->assessment_date  .'", ' . $this->ail_id . 
            ', ' . $this->aml_id . ', ' . $this->atl_id . ', ' . $this->course_id . ')';

            try {

                // prepare statement
                $statement = $this->conn->prepare($query);
                // execute statement
                $this->ok = $statement->execute();

            } catch (PDOException $e) {
                $this->ok = false;
            }

            if ($this->ok) {
                $this->ok = false;

                // get assessment id
                $query = 'SELECT assessment_id FROM assessment WHERE ';
                $query = $query . 'assessment_name="' . $this->assessment_name . '" AND ' . 
                'assessment_weight=' . $this->assessment_weight . ' AND ' .
                'assessment_total=' . $this->assessment_total . ' AND ' .
                'assessment_date="' . $this->assessment_date . '" AND ' .
                'atl_id=' . $this->atl_id . ' AND ' . 'course_id=' . $this->course_id . ' LIMIT 0, 1';

                // prepare statement
                $statement = $this->conn->prepare($query);
                // execute statement
                $this->ok = $statement->execute();

                if ($this->ok) {

                    $this->ok = false;
                    // get assessment_id variable
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    // set assessment id property
                    $this->assessment_id = $row['assessment_id'];

                      // now add marks
                    $length = count($this->csv) - 1;

                    // query mark table
                    $query = 'INSERT INTO mark (mark_total, user_id, assessment_id) VALUES ';
                    
                    for ($i = 1; $i < $length; $i++) {
                    
                        // columns
                        $column = explode(',', $this->csv[$i]);
                    
                        if ($i == $length - 1) {
                            $query = $query . '(' . $column[1] . ',' . $column[0] . ',' . $this->assessment_id . ')';
                        }
                        else {
                            $query = $query . '(' . $column[1] . ',' . $column[0] . ',' . $this->assessment_id . '),';
                        }

                    }

                    try {

                        // prepare statement
                        $statement = $this->conn->prepare($query);
                        // execute statement
                        $this->ok = $statement->execute();
        
                    } catch (PDOException $e) {
                        $this->ok = false;
                    }

                    if ($this->ok) {
                        $this->ok = true;
                    }
                    else {
                        $this->ok = false;
                    }
                }
                else {
                    $this->ok = false;
                }
            }
            else {
                $this->ok = false;
            }
        }

        // get latest results that are within current year
        public function getSummary($courseArray) {

            // start date and end date
            $startDate = date('Y') . '-01-01';
            $endDate = date('Y') . '-12-31';

            $query = 'SELECT
                assessment_id,
                assessment_name,
                assessment_date,
                assessment_total
                FROM assessment WHERE ';
                
            // append course id's
            $length = count($courseArray);
            for ($i = 0; $i < $length; $i++) {

                $query .= '(course_id=' . $courseArray[$i] . ' AND ' .
                'assessment_date BETWEEN \'' . $startDate . '\' AND \'' .
                $endDate . '\') OR ';
            }
            $length -= 5;

            // remove trailing OR
            $query = substr($query, 0, $length);

            // add ordering and limit
            $query .= ' ORDER BY assessment_date DESC LIMIT 0,10';

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            return $statement;
        }

        // return array with 2 numbers pass rate and total students
        public function getPassRate($assessment_id, $assessment_total) {

            // query of students who passed the assessment
            $query = 'SELECT mark_total FROM mark WHERE assessment_id=';
            $query .= $assessment_id . ' AND mark_total >= ' . 0.5 * $assessment_total;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // pass rate
            $pass = $statement->rowCount();

            // query of students who didn't pass the assessment
            $query = 'SELECT mark_total FROM mark WHERE assessment_id=';
            $query .= $assessment_id . ' AND mark_total < ' . 0.5 * $assessment_total;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // fail rate
            $fail = $statement->rowCount();

            return array($pass, $fail);
        }

        // get min and max date for assessment by course id
        public function getMinMaxYear($course_id) {

            // minimum year
            $query = 'SELECT MIN(assessment_date) FROM assessment WHERE course_id=' . $course_id;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // pass rate
            $counter = $statement->rowCount();

            // array for min max year
            $yearRange = array();

            if ($counter > 0) {

                // get columns
                $row = $statement->fetch(PDO::FETCH_NUM);

                // split
                $splitter = explode('-', $row[0]);
                // set
                $yearRange[0] = $splitter[0] + 0;
            }

            // maximum year
            $query = 'SELECT MAX(assessment_date) FROM assessment WHERE course_id=' . $course_id;

            // prepare query
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            // pass rate
            $counter = $statement->rowCount();

            if ($counter > 0) {

                // get columns
                $row = $statement->fetch(PDO::FETCH_NUM);

                // split
                $splitter = explode('-', $row[0]);

                // set
                $yearRange[1] = $splitter[0] + 0;
            }

            // return array
            return $yearRange;
        }
    }
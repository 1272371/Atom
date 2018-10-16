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
    }
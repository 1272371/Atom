<?php

    class Populate {

        private $name;
        private $surname;
        public $username;
        public $usersurname;
        private $filesLoaded;

        function __construct($csvname, $csvsurname) {

            // file returns array
            $this->name = file($csvname, FILE_SKIP_EMPTY_LINES);
            $this->surname = file($csvsurname, FILE_SKIP_EMPTY_LINES);

            // check to see if files loaded properly
            if ($this->name !== false && $this->surname !== false) {
                $this->filesLoaded = true;
            }
            else {
                $this->filesLoaded = false;
            }
        }

        /**
         * gets a random number from csv depending
         * on the number of rows in csv file
         * 
         * @param csv $csv file to read
         * @return randomRow $randomRow random integer
         */
        private function getRandomRowIndex($csv) {

            $rows = count($csv);

            $randomRow = rand(1, $rows - 1);
            return $randomRow;
        }

        public function getRandomAlias() {

            if ($this->filesLoaded) {
                $this->username = $this->name[$this->getRandomRowIndex($this->name)];
                $this->usersurname = $this->surname[$this->getRandomRowIndex($this->surname)];
            }
        }
    }
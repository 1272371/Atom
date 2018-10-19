<?php

    $a = array('42', 14, 15);
    echo $a[0] . 'aweawe';


    class Statistic {

        public function getAverage($data) {

            if (count($data) > 0) {

                // then we have an array and it is safe to divide by count
                $ave;
                $Ex = 0;
                $n = count($data);
                $length = count($data);

                for ($i = 0; $i < $length; $i++) {

                    // declare and check if it's numeric
                    $xi = get_numeric($data[$i]);

                    $Ex = $Ex + $xi;
                }
                $ave = $Ex / $n;
                return $ave;
            }
            else {
                return 0;
            }
        }

        private function get_numeric($val) {
            if (is_numeric($val)) { 
                return $val + 0; 
            } 
            return 0; 
        }
    }
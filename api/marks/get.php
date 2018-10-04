<?php

    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Mark.php';

    // instanciate database and connect
    $database = new Database();
    $db = $database->connect();

    // instantiate mark object
    $mark = new Mark($db);

    // mark post query
    $result = $mark->get();

    // get mark count
    $num = $result->rowCount();

    if ($num > 0) {

        // marks exist
        $markArray = array(
            'name' => 'marks',
            'description' => 'Returns all marks in database by course sorted by year'
        );
        $markArray['content'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $markArray['content'][$course_id] = array(
                'course_id' => $course_id,
                'course_name' => $course_name,
            );

            if (!is_array($markArray['content'][$course_id]['assessments'])) {
                $markArray['content'][$course_id]['assessments'] = array();
            }
            else {

                if (!is_array( $markArray['content'][$course_id]['assessments'][$assessment_id])) {
                    $markArray['content'][$course_id]['assessments'][$assessment_id] = array(
                        'assessment_id' => $assessment_id,
                        'assessment_name' => $assessment_name,
                        'assessment_date' => $assessment_date,
                        'assessment_weight' => $assessment_weight,
                        'assessment_total' => $assessment_total
                    );
                }
                else {
                    if (!is_array($markArray['content'][$course_id]['assessments'][$assessment_id]['data'])) {
                        $markArray['content'][$course_id]['assessments'][$assessment_id]['data'] = array();
                    }
                    else {
                        // calculate percent
                        $percent = (float) $mark_total/$assessment_total;
                        $percent = $percent * 100;

                        $markItem = array(
                            'user_id' => $user_id,
                            'user_name' => $user_name,
                            'user_surname' => $user_surname,
                            'mark_total' => $mark_total,
                            'percent' => $percent
                        );

                        // user entry
                        $markArray['content'][$course_id]['assessments'][$assessment_id]['data'][$user_id] = array();

                        // push to data value in array
                        array_push($markArray['content'][$course_id]['assessments'][$assessment_id]['data'][$user_id], $markItem);
                    }
                }
            }
        }

        echo json_encode($markArray);
    }
    else {

        // no marks exist
        echo json_encode(array('message' => 'no marks found'));
    }
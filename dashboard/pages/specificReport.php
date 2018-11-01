<?php
	 // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once __DIR__ .'/../../api/config/Database.php';
    include_once __DIR__ .'/../../api/models/Mark.php';

    // instanciate database and connect
    $database = new Database('127.0.0.1','risk','root','');
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

            if (empty($markArray['content'][$course_id])) {
                $markArray['content'][$course_id] = array(
                    'course_id' => $course_id,
                    'course_name' => $course_name,
                );
            }
            else {
                // assessments go in course here
                if (empty($markArray['content'][$course_id]['assessments'])) {
                    $markArray['content'][$course_id]['assessments'] = array(
                        'description' => 'Assessment data by assessment_id'
                    );
                }
                else {
                    if (empty( $markArray['content'][$course_id]['assessments'][$assessment_id])) {
                        $markArray['content'][$course_id]['assessments'][$assessment_id] = array(
                            'assessment_id' => $assessment_id,
                            'assessment_name' => $assessment_name,
                            'assessment_date' => $assessment_date,
                            'assessment_weight' => $assessment_weight,
                            'assessment_total' => $assessment_total
                        );
                    }
                    else {
                        if (empty($markArray['content'][$course_id]['assessments'][$assessment_id]['data'])) {
                            $markArray['content'][$course_id]['assessments'][$assessment_id]['data'] = array(
                                'description' => 'Student marks for assignment in student number order'
                            );
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
        }

        //echo json_encode($markArray["content"]["1"]["assessments"]["1"]["data"]);

        /*for ($i = 1;$i < sizeof($markArray["content"]["1"]["assessments"]["1"]["data"] );$i++ ){
        	 print_r( $markArray["content"]["1"]["assessments"]["1"]["data"]) . "\n";
        }*/

 

        require('fpdf/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Helvetica','I',30);

		// Insert a logo in the top-left corner at 300 dpi
		$pdf->Image('../img/wits-logo1.jpg',70,10,-1200);

		// Title
		$pdf->SetXY(53,60);
		$pdf->Write(5,'Risk Assessor Report');

		$pdf->SetXY(10,70);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(37,12,'Name',1);
		$pdf->Cell(37,12,'Surname',1);
		$pdf->Cell(37,12,'Student No.',1);
		$pdf->Cell(37,12,'Mark(%)',1);
		$pdf->Cell(37,12,'Prediction',1);
		$pdf->Ln();

		$pdf->SetXY(10,74);
		$pdf->Ln();

        if (empty($_GET)){
            $course= "1";
            $assessment = "1";
        } else {
            $course_id = $_GET['course'];
            if ($course_id=="bco"){
                $course = 1;
            } else {
                $course = 2;
            }
            $assessment = $_GET['assessment'];
        }
        
        //BCO 1
        //IAP 2
		//$course=1;

        //BCO 1-18
        //IAP 19-45
        //$assignment=1;

        foreach ($markArray["content"][$course]["assessments"][$assessment]["data"] as $student){
        	if ( !($student["0"] == "S")){
        		//print_r( $student["0"]) . "\n";

        		if ($student["0"]["percent"] < 50){
        			$pred = 'At Risk';
        		} else {
        			$pred = 'Safe';
        		}

        		$pdf->Cell(37,12,$student["0"]["user_name"],1);
        		$pdf->Cell(37,12,$student["0"]["user_surname"],1);
        		$pdf->Cell(37,12,$student["0"]["user_id"],1);
        		$pdf->Cell(37,12,round($student["0"]["percent"]),1); 
        		$pdf->Cell(37,12,$pred,1);
        		$pdf->Ln();
        		
        	}
        }
        $pdf->Output();
    }
    else {

        // no marks exist
        echo json_encode(array('message' => 'no marks found'));
    }



?>

<?php
  require_once('DB.php');
  header('Content-Type: application/json');
  header("Cache-Control: no-store,no-cache,must-revalidate,max-age=0");
  header("Cache-Control: post-check=0,pre-check=0",false);

  header("Pragma:no-cache");

  $db=new DB('127.0.0.1','risk','root','');

  if($_SERVER['REQUEST_METHOD']=='GET')
  {
  	if(isset($_GET['course']))
  	{
  	  $grades=$db->query("SELECT m.user_id, u.user_name as user_name, u.user_surname as user_surname, m.assessment_id, a.assessment_weight as assessment_weight, a.assessment_total as assessment_total, a.assessment_date as assessment_date, a.assessment_name as assessment_name, m.mark_total, a.course_id as course_id, c.course_name as course_name from mark m left join assessment a on m.assessment_id=a.assessment_id left join user u on m.user_id=u.user_id left join course c on a.course_id=c.course_id ORDER BY m.user_id ASC");
  	   //echo json_encode($grades);
  	   $pass=0;
       $fail=0;
       $count=0;
       $total=0;
       $course_id=$_GET['course'];
       //echo $course_id;
  	   foreach ($grades as $g) 
  	   {
  	   		if($g['course_id']==$course_id)
  	   		{
  	   			if($count<3)
  	   			{
  	   				$total=$total+$g['assessment_total'];
  	   				$count=$count+1;
  	   			}
  	   			if($count==3)
  	   			{
  	   				$mark=($total/300)*100;
  	   				if($mark<50)
  	   				{
  	   					$fail=$fail+1;
  	   				}
  	   				else
  	   				{
  	   					$pass=$pass+1;
  	   				}
  	   				$count=0;
  	   				$total=0;
  	   			}
  	   		} 

  	   }
  	   echo '{"pass":"'.$pass.'","fail":"'.$fail.'"}';
  	}
   }
?>
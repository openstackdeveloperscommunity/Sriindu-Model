<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("M,d,Y h:i:s A");
$db = mysqli_connect('localhost','root','','sriindumodels');
    $facultyname = test_input($_POST["faculty"]);
	$year = test_input($_POST["year"]);
	$subject = test_input($_POST["subject"]);
    if (preg_match("/^(?!\.)[A-Za-z. ]+$/", $facultyname)){
    	$link=test_input($_POST["link"]);
			$query="select * from faculty_details where faculty_name='".$facultyname."'";
			$result=mysqli_query($db,$query)
				or die("try again");
			$faculty=mysqli_fetch_array($result);
			if($faculty['faculty_name'] == $facultyname){
				$query="select * from student_details where rollno='".$_SESSION['rollno']."'";
        		$result=mysqli_query($db,$query)
          				or die("try again");
				$student=mysqli_fetch_array($result);
				$query="insert into submissions values('".$faculty['facultyid']."','".$student['rollno']."','".$faculty['faculty_name']."','".$student['name']."','".$link."','".$timestamp."','no','".$year."','".$subject."',0)";
			    if(mysqli_query($db,$query)){
					$row = $student['submissions']+1;
					$query="update student_details set submissions=".$row." where rollno='".$_SESSION['rollno']."'";
        			mysqli_query($db,$query)
          				or die("try again");
                	?><script> alert("Assignment submitted successfully");window.location = "../student";</script><?php
                }
			}else{
				echo "Something went wrong";
			}
	}else{
        echo "Something went wrong";
    }
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
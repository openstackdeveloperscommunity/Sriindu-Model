<?php
session_start();
$db = mysqli_connect('localhost','root','','sriindumodels');
    $id = test_input($_POST["id"]);
    if (preg_match("/^[_a-zA-Z0-9]+$/", $id)){
    	$password=test_input($_POST["password"]);
    	if (preg_match("/^[_a-zA-Z0-9]+$/", $password)){
			$query="select * from faculty_details where facultyid='".$id."' and password='".$password."'";
			$result=mysqli_query($db,$query)
				or die("try again");
			$row=mysqli_fetch_array($result);
			if($row['facultyid'] == $id){
				$_SESSION['faculty_id'] = $row['facultyid'];
				$_SESSION['account'] = "faculty";
				header("Location: dashboard");exit;
			}else{
				$query="select * from student_details where rollno='".$id."' and password='".$password."'";
				$result=mysqli_query($db,$query)
					or die("try again");
				$row=mysqli_fetch_array($result);
				if($row['rollno'] == $id){
					$_SESSION['rollno'] = $row['rollno'];
					$_SESSION['account'] = "student";
					header("Location: student");exit;
				}else{
					echo "id or password is incorrect*";
				}
			}
		}else{
			echo "Please write proper password";
		}

	}
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	?>
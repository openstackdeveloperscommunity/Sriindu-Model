<?php
    $db = mysqli_connect('localhost','root','','sriindumodels');
    $query="UPDATE submissions SET marks=".$_POST['marks'].",verify_status='yes' WHERE rollno='".$_POST['rollno']."' and facultyid='".$_POST['faculty_id']."'";
        if(mysqli_query($db,$query))
         {
            ?><script> alert("verification successfully");window.location = "../dashboard";</script><?php
         }else{
            ?><script> alert("verification unsuccessfull");window.location = "../dashboard";</script><?php
         }
?>
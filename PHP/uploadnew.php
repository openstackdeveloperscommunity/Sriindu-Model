<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="./CSS/style.css" rel="stylesheet">
  <link href="./CSS/style-responsive.css" rel="stylesheet">
  <style>
    .submissionform {
        height: auto;
        width: 300px;
        background: #2f323a;
        margin-left: 45%;
        margin-top: 5%;
        text-align: center;
    }
    input {
        width: 80%;
        height: 30px;
        margin: 20px 30px;
        border: none;
        border-radius: 30px;
        text-align: center;
    }
    input[type="submit"] {
        width: 30%;
        height: 30px;
        margin: 25px 100px;
    }
    select {
        width: 80%;
        height: 35px;
        margin: 25px 30px;
        border: none;
        border-radius: 30px;
        text-align: center;
    }
    .submissionform h3 {
        color: white;
        padding-top: 30px;
    }
    input:focus,select:focus {
        outline: none;
    }
  </style>
</head>

<body>
  <?php
    session_start();
    error_reporting(0);
    if ($_SESSION['rollno'] == '') {
      header('Location: ./index');
    }
  ?>
  <section id="container">
    <header class="header black-bg">
      <a href="#" class="logo"><b>SICET ASSESMENT <span>PANEL</span></b></a>

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="PHP/logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <?php
      $db = mysqli_connect('localhost','root','','sriindumodels');
        $query="select * from student_details where rollno='".$_SESSION['rollno']."'";
        $result=mysqli_query($db,$query)
          or die("try again");
        $row=mysqli_fetch_array($result);
    ?>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="#"><img src="<?php echo $row['Profilepic']; ?>" class="img-circle" width="150"></a></p>
          <h4 class="centered"><?php echo $row['name']; ?></h4>
          <p class="details"><span>RollNo : </span><?php echo $row['rollno']; ?></p>
          <p class="details"><span>Year : </span><?php echo $row['year']; ?></p>
          <p class="details"><span>Department : </span><?php echo $row['department']; ?></p>
          <p class="details"><span>Total Submissions : </span><?php echo $row['submissions']; ?></p>
        </ul>
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">
                <div class="border-head">
                    <h3>Assignment Submissions</h3>
                </div>
                <div class="row">
                    <form method="POST" class="submissionform" action="PHP/upload.php">
                        <h3>Upload New</h3>
                        <input type="text" placeholder="enter year" name="year" required>
                        <input type="text" placeholder="Enter drivelink"  name="link" required>
                        <select name="faculty" id="faculty" required>
                            <option>Choose Your Faculty</option>
                            <?php
                              $query="select faculty_name from faculty_details";
                              $result=mysqli_query($db,$query)
                                or die("try again");
                              $row=mysqli_fetch_array($result);
                              foreach ($result as $name) {
                                echo "<option>".$name['faculty_name']."</option>";
                              }
                            ?>
                        </select>
                        <select name="subject" id="subject" required>
                            <option>Choose subject</option>
                            <option>C++</option>
                            <option>DBMS</option>
                            <option>JAVA</option>
                            <option>CN</option>
                            <option>OS</option>
                            <option>IS</option>
                            <option>WT</option>
                            <option>DLD</option>
                            <option>OOAD</option>
                        </select>
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
      </section>
    </section>
  </section>
</body>

</html>

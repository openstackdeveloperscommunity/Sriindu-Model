<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="./CSS/style.css" rel="stylesheet">
  <link href="./CSS/style-responsive.css" rel="stylesheet">
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
          <li><a class="logout" href="upload">ASSESSMENTS</a></li>
          <li><a class="logout" href="upload">Upload Assignment</a></li>
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
                <?php
                $db = mysqli_connect('localhost','root','','sriindumodels');
                  $query="select * from submissions where rollno='".$row['rollno']."'";
                  $result=mysqli_query($db,$query)
                      or die("No data to display");

                  foreach ($result as $assignment) {
              ?>
                <div class="row">
                  <div class="col-md-12 mb">
                    <div class="message-p pn">
                      <div class="message-header">
                        <h5>Submitted To : <span><?php echo $assignment['ft_name']; ?></span></h5>
                      </div>
                      <div class="row">
                        <div class="col-md-9">
                        <p class="small">Subject : <span><?php echo $assignment['subject']; ?></span></p>
                        <p class="small">Assignment Link : <span><a href="<?php echo $assignment['link']; ?>" target="_blank"><?php echo $assignment['link']; ?></a></span></p>
                          <p class="small">
                          <?php echo $assignment['timestamp']; ?>
                          </p>
                          <p class="small">
                            Verify Status : <span><?php echo $assignment['verify_status']; ?></span>
                          </p>
                          <p class="small">
                            Marks : <span><?php echo $assignment['marks']; ?></span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  
              <?php
                }
              ?>
            </div>
        </div>
      </section>
    </section>
  </section>
</body>

</html>

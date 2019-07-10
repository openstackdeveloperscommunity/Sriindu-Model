<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="./CSS/style.css" rel="stylesheet">
  <link href="./CSS/style-responsive.css" rel="stylesheet">
</head>

<body>
  <?php
    session_start();
    error_reporting(0);
    if ($_SESSION['faculty_id'] == '') {
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
        $query="select * from faculty_details where facultyid='".$_SESSION['faculty_id']."'";
        $result=mysqli_query($db,$query)
          or die("try again");
        $row=mysqli_fetch_array($result);
    ?>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="#"><img src="<?php echo $row['Profilepic']; ?>" class="img-circle" width="150"></a></p>
          <h4 class="centered"><?php echo $row['faculty_name']; ?></h4>
          <p class="details"><span>Designation : </span><?php echo $row['faculty_designation']; ?></p>
          <p class="details"><span>Qualification : </span><?php echo $row['faculty_qualification']; ?></p>
          <p class="details"><span>University : </span><?php echo $row['faculty_university']; ?></p>
          <p class="details"><span>Date of join : </span><?php echo $row['date_of_join']; ?></p>
          <p class="details"><span>Date of designation : </span><?php echo $row['date_of_designation']; ?></p>
          <p class="details"><span>Department : </span><?php echo $row['faculty_department']; ?></p>
          <p class="details"><span>Specialization : </span><?php echo $row['faculty_specialization']; ?></p>
        </ul>
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <div class="border-head">
              <h3>STUDENTS AND ASSIGNMENTS(4THYEAR)</h3>
            </div>
              <?php
                $db = mysqli_connect('localhost','root','','sriindumodels');
                  $query="select * from submissions where facultyid='".$row['facultyid']."'";
                  $result=mysqli_query($db,$query)
                      or die("No data to display");

                  foreach ($result as $assignment) {
              ?>
                <div class="row">
                  <div class="col-md-12 mb">
                    <div class="message-p pn">
                      <div class="message-header">
                        <h5><?php echo $assignment['rollno']; ?></h5>
                      </div>
                      <div class="row">
                        <div class="col-md-9">
                        <div class="verify">
                          <?php  
                            if($assignment['verify_status'] == "no"){

                          ?>
                            <button class="<?php echo $assignment['rollno']; ?>" onclick="verify(this);">Verify</button>
                            <div  id="<?php echo $assignment['rollno']; ?>">
                          
                          </div>
                          <?php   
                          }else{
                            echo "<p>Verified</p><p>Marks : ".$assignment['marks']."</p>";
                          }
                          ?>
                          </div>
                          <p>
                            <?php echo $assignment['st_name']; ?>
                          </p>
                          <p class="small">
                          <?php echo $assignment['year']; ?>
                          </p>
                          <p class="small">
                          <?php echo $assignment['timestamp']; ?>
                          </p>
                          <p class="small">Assignment Link : <span><a href="<?php echo $assignment['link']; ?>" target="_blank"><?php echo $assignment['link']; ?></a></span></p>
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
  <script>
      function verify(rollno){
        
        document.getElementById(rollno.className).innerHTML='<form action="PHP/marks.php" method="post"><select name="marks"><option value="">Marks</option><option value="5">5</option><option value="4">4</option><option value="3">3</option></select><input type="hidden" name="rollno" value="<?php echo $assignment['rollno']; ?>"><input type="hidden" name="faculty_id" value="<?php echo $_SESSION['faculty_id']; ?>"><input type="submit" value="submit"></form>';
      }
  </script>
</body>

</html>

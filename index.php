<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="./CSS/login.css">
    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            window.location.href="http://sriindu.ac.in/"
        };
  </script>
</head>
    <body>
    <div class="login-box">
        <h1>Login</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="id" placeholder="Enter your id" id="rollno" required="yes">
                <input type="password" name="password" placeholder="Enter Password" id="password" required="yes"><br><br>
                <input type="submit" name="submit" value="Login" id="button"><br>
                <!-- <a href="#">Forgot Password..!</a><br><br> -->
                <p id="page">
                    <?php
                        error_reporting(0);
                        include("./PHP/validator.php");
                    ?>
                </p>
            </form>
        </div>

    </body>
</html>

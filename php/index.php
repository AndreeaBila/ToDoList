<?php 
  session_start(); 
  session_destroy();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>To Do List</title>

    <!--Bootstrap-->
    <link href="../../Bootstrap2/css/bootstrap.min.css" rel="stylesheet"> 

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.min.css"> 

    <!-- My CSS -->
    <link href="../css/main.css" rel="stylesheet"> 
    <!-- Icon -->
    <!-- <link rel="shortcut icon" href="../img/#"> -->

    <!-- JavaScript -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/#"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->        
  </head>
  <body>
    <?php
      include 'header.php';
    ?>

    <div class="jumbotron">
      <div class="container">
        <h1 class="text-center">Start Creating Your Lists</h1>

        <div class="align-bottom">
          <p class="text-center"><a class="btn btn-primary btn-lg myBtn" id="learnMore" href="#" role="button">Learn more</a></p>
        </div>
      </div>
    </div>

    <form class="loginForm text-center" id="loginForm">
      <h2>Log In</h2>

      <div class="form-group form-inline">
        <label for="username"><i class="fa fa-user-circle" aria-hidden="true"></i></label>
        <input class="form-control" type="text" name="username" id="loginUsername" placeholder="Username"  required>
      </div>

      <div class="form-group form-inline">
        <label for="password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
        <input class="form-control" type="password" name="password" id="loginPassword" placeholder="Password"  required>
      </div>
      
      <div class="alert alert-danger alert-dismissable alert-custom" id="login_generalAlert">
        <a class="close" aria-label="close">&times;</a>
        <strong>Error!</strong> The username or password are incorrect.
      </div>

      <div class="checkbox">
          <input type="checkbox" name="logInCheckbox" id="logInCheckbox"> Keep me loged in
      </div>

      <input class="myBtn" type="button" name="submit" id="loginSubmit" value="Log In"><br>

      <a href="#" class="redirects" id="loginCreateAccount">Create Account</a>
    </form>


    <form action="signUp.php" method="POST" onsubmit="return verifySignUp()" class="signupForm text-center" id="signupForm">
      <h2>Create Account</h2>

      <div class="form-group form-inline">
        <label for="username"><i class="fa fa-user-circle" aria-hidden="true"></i></label>
        <input class="form-control" type="text" name="username" id="signupUsername" placeholder="Username" required>
      </div>
      <div class="alert alert-danger alert-dismissable alert-custom" id="signup_generalAlert">
        <a class="close" aria-label="close">&times;</a>
        <strong>Error!</strong> This username is already in use.
      </div>

      <div class="form-group form-inline">
        <label for="password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
        <input class="form-control" type="password" name="password" id="signupPassword" placeholder="Password" required>
      </div>

      <div class="form-group form-inline">
        <label for="Retype Password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
        <input class="form-control" type="password" name="password" id="signupRePassword" placeholder="Retype Password" required>
      </div>
      <div class="alert alert-warning alert-dismissable alert-custom" id="signup_passwordAlert">
        <a class="close" aria-label="close">&times;</a>
        <strong>Warning!</strong> The two passwords do not match.
      </div>
        
      <div class="form-group form-inline">
        <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
        <input class="form-control" type="email" name="email" id="signupEmail" placeholder="Email" required>
      </div>
      <div class="alert alert-danger alert-dismissable alert-custom" id="signup_generalAlert">
        <a class="close" aria-label="close">&times;</a>
        <strong>Error!</strong> The provided email address is already in use.
      </div>
      <div class="alert alert-info alert-dismissable alert-custom" id="signup_fillDetailsAlert">
        <a class="close" aria-label="close">&times;</a>
        <strong>Sorry!</strong>You have to fill in all the details and a valid email adress!
      </div>

      <div class="form-group form-inline">
        <label for="dateOfBirth"><i class="fa fa-birthday-cake" aria-hidden="true"></i></label>
        <input class="form-control" type="text" name="signupDoB" id="signupDoB" onfocus="(this.type='date')" placeholder="Date of Birth" required>
      </div>

      <div class="checkbox">
        <label>
          <input type="checkbox" required> <a href="#">I agree with the Terms and Conditions</a>
        </label>
      </div>

      <input class="myBtn" type="submit" name="submit" id="signupSubmit" value="Sign Up"><br>
      
      <a href="#" class="redirects" id="signupBackToLogin">Already Have An Account</a>
    </form>

    
    <?php
      include 'footer.php';
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../Bootstrap/js/bootstrap.min.js"></script> 

    <!-- The js script for this file -->
    <script src="../js/login.js"></script>
  </body>
</html>

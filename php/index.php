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

    <title>List Manager</title>

    <meta name="description" content="You can manage your to do list, your shopping list and any other list with
     our easy to use list manager. Add, remove and edit any list and any item with ease.">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/8dd7dadaef.js"></script> 

    <!--Google Fonts for this project-->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway" rel="stylesheet">

    <!-- My CSS -->
    <link href="../css/main.css" rel="stylesheet"> 
    <!-- Icon -->
     <link rel="shortcut icon" href="../img/small.png"> 

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
    <div class="wrapper">
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
        
        <div class="text-center alert alert-danger alert-dismissable alert-custom" id="login_generalAlert">
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
        <div class="text-center alert alert-danger alert-dismissable alert-custom" id="signup_generalAlert">
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
        <div class="text-center alert alert-warning alert-dismissable alert-custom" id="signup_passwordAlert">
          <a class="close" aria-label="close">&times;</a>
          <strong>Warning!</strong> The two passwords do not match.
        </div>
          
        <div class="form-group form-inline">
          <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
          <input class="form-control" type="email" name="email" id="signupEmail" placeholder="Email" required>
        </div>
        <div class="text-center alert alert-danger alert-dismissable alert-custom" id="signup_generalAlert">
          <a class="close" aria-label="close">&times;</a>
          <strong>Error!</strong> The provided email address is already in use.
        </div>
        <div class="text-center alert alert-info alert-dismissable alert-custom" id="signup_fillDetailsAlert">
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

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 

    <!-- The js script for this file -->
    <script src="../js/login.js"></script>
  </body>
</html>

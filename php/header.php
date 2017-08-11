<header class="headerStyle">
  <!--<link rel="stylesheet" href="../css/header.css">-->
  <nav>
    <div class="pull-left"><a href="main.php"><img id="logo" src="../img/logo2.png" alt="Lists"></a></div> 
  
    <ul class="pull-right" id='btnLogIn_Out'>
      <li><a href="main"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      
      <?php
        if(isset($_SESSION['ID'])){
          echo '<li><a href="settings"><i class="fa fa-wrench" aria-hidden="true"></i> Settings';
        }else{
          echo '';
        }?>
      <li><a href="#"><?php
        if(isset($_SESSION['ID'])){
          echo '<i class="fa fa-sign-out" aria-hidden="true"></i> Log Out';
        }else{
          echo '<i class="fa fa-sign-in" aria-hidden="true"></i> Log In';
        }
      ?></a></li>
    </ul>        
  </nav>

</header>
  <div class="clear"></div>

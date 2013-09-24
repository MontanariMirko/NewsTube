<?php
  session_start();
  $_SESSION['login'] = false;
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>NewsTube</title>
  <link href="mobile.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
  
  <div class="logo">
  <img src="images/conc_bluebg.gif">
  </div>
  <div class="menu">
  <span align=center>Login</span>
  </div>
    <?php include('_form.php') ?>  
  </body>
</html>

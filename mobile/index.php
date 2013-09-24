<?php
   include('../config.inc.php');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>NewsTube</title>
  <link href="mobile.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
    A:link {text-decoration: none; color: red;}
    A:visited {text-decoration: none; color: red;}
    A:active {text-decoration: none; color: red;}
    A:hover {text-decoration: none; color: red;}
</style>
  </head>
  <body>
  <div class="logo">
  <img src="images/conc_bluebg.gif">
  </div>
  <div class="menu">
  <span align=center>Benvenuti in NewsTube</span>
  </div><br>
    Se hai una connessione lenta conisgliamo il sito versione mobile:<br>
    <a href="index2.php">NewsTube Mobile</a><br>
    dove potrai aggiungere contenuti, moderare o modificare gli schermi.<br><br><br>
    Se invece preferisci aver un controllo completo entra nel sito:<br>
    <a href="<?= ADMIN_URL ?>">NewsTube</a>   
  </body>
</html>

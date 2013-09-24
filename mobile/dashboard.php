<?php
  session_start();

include('../config.inc.php');
include('../version.inc.php');
//Classes and Libraries:
include(COMMON_DIR.'mysql.inc.php');//Tom's sql library interface + db connection settings
include(COMMON_DIR.'user.php');     //Class to represent a site user
include(COMMON_DIR.'screen.php');   //Class to represent a screen in the system
include(COMMON_DIR.'feed.php');     //Class to represent a content feed

error_reporting (0);
  
  $db_host = 'mysql.comune.carpi.mo.it';
  $db_login = 'concerto';
  $db_password = 'qelpdc';
  $db_database = 'concerto';
  $link = mysql_pconnect($db_host, $db_login, $db_password);
  $db_selected = mysql_select_db($db_database, $link);

if($_SESSION['login'] != "connesso"){ 
   $user = $_REQUEST['user'];  
   $pwd = md5($_REQUEST['pwd']);
   $query = "SELECT * FROM `user` WHERE `username` = '".$user."' AND `password` = '".$pwd."'";
   $res = mysql_query($query);
   $line = mysql_fetch_array($res);
   if($line['username'] == false){
      include('login.php');
      $_SESSION['login'] = false;
    }else {
        $_SESSION['utente'] = $line['name'];
        $_SESSION['login'] = "connesso";
    }
}    
if($_SESSION['login'] == "connesso"){
   $sql = 'SELECT feed_content.feed_id as feed_id, COUNT(content.id) as cnt '.
          'FROM feed_content '.
          'LEFT JOIN content ON feed_content.content_id = content.id '.
          'WHERE feed_content.moderation_flag IS NULL '.
          'GROUP BY feed_content.feed_id;';
   $res = sql_query($sql);
  $sql1 = "SELECT * from user WHERE name = '".$_SESSION['utente']."'";
  $res1 = sql_query($sql1);
  $ut = sql_row_keyed($res1,0);
  $utente = new User($ut['username']);
  
   $more_waiting = 0;
   $mod_feeds = 0;
   for($i = 0;$row = sql_row_keyed($res,$i);++$i){
      $count = $row['cnt'];
      $feed = new Feed($row['feed_id']);
      if($feed->user_priv($utente, 'moderate',true)) {
         $mod_feeds=$row['cnt'];
      } else {
         $more_waiting += $row['cnt'];
      }
   }  
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>NewsTube</title>
  <link href="mobile.css" type="text/css" rel="stylesheet"/>
      <style type="text/css">
      A:link {text-decoration: none; color: white;}
      A:visited {text-decoration: none; color: white;}
      A:active {text-decoration: none; color: white;}
      A:hover {text-decoration: none; color: white;}
      
      A.mail:link {text-decoration: none; color: white;}
      A.mail:visited {text-decoration: none; color: white;}
      A.mail:active {text-decoration: none; color: red;}
      A:.mailhover {text-decoration: none; color: red;}
      </style>
  </head>
  <body>
  
  <div class="logo">
  <a href="dashboard.php"><img src="images/conc_bluebg.gif"></a> 
  </div>
  <div class="menu">
  <span><a href="add.php">Aggiungi</a></span>&nbsp;&nbsp;  
  <span><a href="mod.php">Modera</a>
  <?
  if($ut['admin_privileges'] == 1 && $more_waiting > 0)
      echo "(".$more_waiting.")";
  elseif($mod_feeds > 0)
      echo "(".$mod_feeds.")";
  ?>
  </span>&nbsp;&nbsp;
  <span><a href="schermi.php">Schermi</a></span>
  </div> <br>
    Benvenuto <a href="utente.php"><b><? echo $_SESSION['utente'] ?></b></a>!  <br><br>
    <b>Stato degli schermi</b><br>
    
   <? $statistiche = Screen::screenStats();
      
      ?>
	   	<?php echo $statistiche[0] ?> online<br>
	   	<?php echo $statistiche[2] ?> sleep<br>
	   	<?php echo $statistiche[1] ?> offline<br><br> <br><br> 
	   	Sviluppato da <b>Montanari Mirko</b> in collaborazione con il SIA dell'<b>Unione delle Terre d'Argine</b><br>
	   	<a href="mailto:<?= SYSTEM_EMAIL ?>" class="mail"><b>Contattaci</b></a>
	   	<div id="footer_bar">
	   	<a href="index2.php">Esci</a>
	   	</div>
  </body>
</html>

<? 

}
?>

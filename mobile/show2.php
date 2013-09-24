<?php
  session_start();
include('../config.inc.php');
//The version number, and other non-user globals:
include('../version.inc.php');
//Classes and Libraries:
include(COMMON_DIR.'mysql.inc.php');//Tom's sql library interface + db connection settings
include(COMMON_DIR.'user.php');     //Class to represent a site user
include(COMMON_DIR.'screen.php');   //Class to represent a screen in the system
include(COMMON_DIR.'feed.php');     //Class to represent a content feed
include(COMMON_DIR.'field.php');    //Class to represent a field in a template
include(COMMON_DIR.'position.php'); //Class to represent a postion relationship
include(COMMON_DIR.'content.php');  //Class to represent content items
include(COMMON_DIR.'upload.php');   //Helps uploading
include(COMMON_DIR.'group.php');    //Class to represent user groups
include(COMMON_DIR.'dynamic.php');  //Functionality for dynamic content
include(COMMON_DIR.'notification.php');  //Functionality for notifications
include(COMMON_DIR.'newsfeed.php');  //Functionality for notifications
include(COMMON_DIR.'template.php');  //Class to represent a template
include(COMMON_DIR.'image.inc.php'); //Image library, used for resizing images
error_reporting (0);

  $db_host = 'mysql.comune.carpi.mo.it';
  $db_login = 'concerto';
  $db_password = 'qelpdc';
  $db_database = 'concerto';
  $link = mysql_pconnect($db_host, $db_login, $db_password);
  $db_selected = mysql_select_db($db_database, $link);
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
    <title>NewsTube
    </title>  
    <link href="mobile.css" type="text/css" rel="stylesheet"/>  
    <style type="text/css">
A:link {text-decoration: none; color: white;}
A:visited {text-decoration: none; color: white;}
A:active {text-decoration: none; color: white;}
A:hover {text-decoration: none; color: white;}

A.sc:link {text-decoration: none; color: black;}
A.sc:visited {text-decoration: none; color: black;}
A.sc:active {text-decoration: none; color: black;}
A.sc:hover {text-decoration: none; color: black;}
</style>
  </head>  
  <body>     
    <div class="logo">  
      <a href="dashboard.php"><img src="images/conc_bluebg.gif"></a>  
    </div>  
    <div class="menu">  
      <span><a href="add.php">Aggiungi</a>
      </span>&nbsp;&nbsp;     
      <span><a href="mod.php">Modera</a>
  <?
  if($ut['admin_privileges'] == 1 && $more_waiting > 0)
      echo "(".$more_waiting.")";
  elseif($mod_feeds > 0)
      echo "(".$mod_feeds.")";
  ?>
  </span>&nbsp;&nbsp;   
      <span style=" background-color: #99CCFF">&nbsp;<a href="schermi.php">Schermi</a>&nbsp;</span>   
    </div>  
    <div align=center> 
    <div class="login_error">Aggiornamento riuscito</div>
    <form id="edit" name="edit" method="post" action="edit.php"> 
<?
  $id = $_REQUEST['id'];
  $schermo = new Screen($id);
  
  if($ut['admin_privileges'] == 1)
      $edit = true;
  else{
       $query = "SELECT * FROM `user_group`,user WHERE user_group.user_id=user.id AND group_id='".$schermo->group_id."' and username='".$ut['username']."'";
       $ris = sql_query($query);
       if($ris){
       $group = sql_row_keyed($ris,0);
       if(!$group)
          $edit = false;
       else
          $edit = true;
       }
  }
?>
<h2>Schermo "<?= $schermo->name; ?>"</h2>

Luogo<br>
<input type=text name="luogo" value="<?= $schermo->location; ?>" <?if(!$edit)echo"disabled";?>> <br>
Dimensione<br>
<input type=text name="x" value="<?= $schermo->width; ?>" size=4 <?if(!$edit)echo"disabled";?>> x <input type=text name="y" value="<?= $schermo->height; ?>" size=4 <?if(!$edit)echo"disabled";?>><br>
Stato<br>
<?
if ($schermo->is_connected()&&$schermo->get_powerstate()) {		// screen is ONLINE
				$stato = "Online";
				$colore = "green";
			} else if ($schermo->is_connected()&&!$schermo->get_powerstate()) {  // screen is ASLEEP
				$stato = "Asleep";
				$colore = "#aa0";
			} else {	// screen is OFFLINE
				$stato = "Offline";
				$colore = "red";
			}
?>
<font color="<?= $colore; ?>"><b><?= $stato; ?></b></font><br>
Gruppo<br>
<select name="gruppo" <?if(!$edit)echo"disabled";?>>
<?php 
$sql = "SELECT * FROM `group`";
$res = sql_query($sql);
for($i = 0;$group = sql_row_keyed($res,$i);++$i){
?>
						<option value="<?= $group['id'] ?>"<?php if($schermo->group_id==$group['id']) echo ' SELECTED'; ?>><?=$group['name']?></option>
<?php   } ?>
</select><br>
Indirizzo MAC<br>
<input type=text name="mac" value="<?= $schermo->mac_inhex; ?>" <?if(!$edit)echo"disabled";?>><br><br>
<input type=hidden name="id" value="<?=$schermo->id; ?>">
<input type=submit name="Modifica" value="Modifica" <?if(!$edit)echo"disabled";?>> <br><br>
    </div>  

  </body>
</html>
<?
 }else
    include('login.php');
?>
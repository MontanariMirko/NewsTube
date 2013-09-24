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

A.app:link {text-decoration: none; color: green;}
A.app:visited {text-decoration: none; color: green;}
A.app:active {text-decoration: none; color: green;}
A.app:hover {text-decoration: none; color: green;}

A.neg:link {text-decoration: none; color: red;}
A.neg:visited {text-decoration: none; color: red;}
A.neg:active {text-decoration: none; color: red;}
A.neg:hover {text-decoration: none; color: red;}
</style>
  </head>  
  <body>     
    <div class="logo">  
      <a href="dashboard.php"><img src="images/conc_bluebg.gif"></a>  
    </div>  
    <div class="menu">  
      <span><a href="add.php">Aggiungi</a>
      </span>&nbsp;&nbsp;     
      <span style=" background-color: #99CCFF">&nbsp;<a href="mod.php">Modera</a> 
  <?
  if($ut['admin_privileges'] == 1 && $more_waiting > 0)
      echo "(".$more_waiting.")";
  elseif($mod_feeds > 0)
      echo "(".$mod_feeds.")";
  ?>&nbsp;</span>&nbsp;&nbsp;   
      <span>
        <a href="schermi.php">Schermi</a>
      </span>  
    </div>  
    <div align=center>  
<?
if($mod_feeds > 0 || $more_waiting > 0){
  $sql = "SELECT * from user WHERE name = '".$_SESSION['utente']."'";
  $res = sql_query($sql);
  $ut = sql_row_keyed($res,0);
  if($ut['admin_privileges'] == 1)
      $query = "SELECT content.*, feed_content.feed_id FROM `content`, feed_content WHERE feed_content.moderation_flag is null and content.id = feed_content.content_id";
  else
      $query = "SELECT content.*, feed_content.feed_id
                FROM content, feed_content,feed,`group`,user_group,user
                WHERE content.id = feed_content.content_id
                AND feed_content.feed_id = feed.id
                AND feed.group_id = `group`.id
                AND `group`.id = user_group.group_id
                AND user_group.user_id = user.id
                AND user.username = '".$ut['username']."'
                AND feed_content.moderation_flag is null";
  $res = sql_query($query);
  
  $i = 0;
  for($i = 0;$row = sql_row_keyed($res,$i);++$i){
      echo "<b>Contenuto del feed</b><br>";
      if($row['mime_type'] == "image/jpeg")
          echo "<a href=\"".ADMIN_URL."/content/image/".$row['content']."\"><img  src=\"".ADMIN_URL."/content/image/".$row['content']."?width=50&amp;height=37\" /></a><br><br>";
      else
          echo $row['content']."<br><br>";
      echo "<b>Titolo</b><br>";
      echo $row['name']."<br><br>";
      echo "<b>Data inizio</b><br>";
      echo date("d/m/Y H:i:s",strtotime($row['start_time']))."<br><br>";
      echo "<b>Data fine</b><br>";
      echo date("d/m/Y H:i:s",strtotime($row['end_time']))."<br><br>";
      echo "<b>Gruppo Feed</b><br>";
      $query2 = "SELECT feed.name from feed,feed_content where feed_content.feed_id=feed.id and feed.id=".$row['feed_id']." group by feed.name";
      $res2 = sql_query($query2);
      $row2 = sql_row_keyed($res2, 0);
      echo $row2['name']."<br><br>";
      echo "<b>Mittente</b><br>";
      
      $query2 = "SELECT user.name from user, content where content.user_id=user.id and content.user_id=".$row['user_id']." group by content.user_id";
      $res2 = sql_query($query2);
      $row2 = sql_row_keyed($res2, 0);
      echo $row2['name']."<br><br>";
      echo "<b><a href=\"approve.php?ok=si&id=".$row['id']."&fid=".$row['feed_id']."\" class=app>Approva</a> ";
      echo "&nbsp;&nbsp;&nbsp;";
      echo "<a href=\"approve.php?no=si&id=".$row['id']."&fid=".$row['feed_id']."\" class=neg> Rifiuta</a></b>";
      
      if($ut['admin_privileges'] == 1){
          if($i < $more_waiting-1)
              echo "<HR width=\"90%\" align=center>";
      }elseif($i < $mod_feeds-1)
              echo "<HR width=\"90%\" align=center>";      
  }
  if($i == 0)
    echo "<br><br>Nessun contenuto da moderare.";
}else
    echo "<br><br>Nessun contenuto da moderare.";

?>

    </div>  
  </body>  
</html>
<?
 }else
    include('login.php');
?>
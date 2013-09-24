<?php
session_start();
include('../config.inc.php');
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
    $id = $_REQUEST['id'];
    $fid = $_REQUEST['feed_id'];
    //echo "$approve <br> $id <br> $fid";
        $query = "SELECT * FROM user WHERE name = '".$_SESSION['utente']."'";
        $res = sql_query($query);
        $utente = sql_row_keyed($res, 0);
        $val = $_REQUEST['motivo'];
        if($val == 1)
            $motivazione = "Il tuo contenuto non &egrave; applicabile al mio feed.";
        elseif($val == 2)
            $motivazione = "Il tuo contenuto &egrave; troppo difficile da leggere.";
        elseif($val == 3)
            $motivazione = "Il tuo contenuto &egrave; ridondante.";
        else
            $motivazione = "Il tuo contenuto &egrave; inappropriato.";
        $motivo2 = $_REQUEST['motadd'];
        $motivazione = $motivazione." ".$motivo2;
        $user = new User($utente['username']);
        $feed_group = new Feed($fid);
        $query2 = "SELECT content.*, feed_content.feed_id FROM `content`, feed_content WHERE content.id = feed_content.content_id and id ='".$id."' and feed_id ='".$fid."'";
        $res2 = sql_query($query2);
        $feed = sql_row_keyed($res2, 0);
        $return_code = $feed_group->content_mod($feed['id'], 0, $user, $feed['duration'], $motivazione);
        if($return_code == true)
            header( "Location: mod.php" ); 
}else
    include('login.php');         
?>

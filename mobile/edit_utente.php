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
    $nome = $_REQUEST['nome'];
    $mail = $_REQUEST['mail'];
    $notif = $_REQUEST['notifiche'];
    $sql1 = "SELECT * from user WHERE name = '".$_SESSION['utente']."'";
    $res1 = sql_query($sql1);
    $ut = sql_row_keyed($res1,0);
    $utente = new User($ut['username']);   
    $utente->name = $nome;
    $utente->email = $mail;
    if($notif == "checked")
        $utente->allow_email = 1;
    else
        $utente->allow_email = 0;
    if($utente->set_properties()){
        $_SESSION['utente'] = $utente->name;
        header("Location: utente_new.php");
    }
    else
        header("Location : err_utente.php");
                     
}else
    include('login.php');         
?>

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
    $errore = false;
    $sql = "SELECT * FROM user WHERE name='".$_SESSION['utente']."'";
    $res = sql_query($sql);
    $ut = sql_row_keyed($res,0);
    $utente = new User($ut['username']); 
    $contenuto = $_FILES['contenuto'];
    if ($_FILES['contenuto']['error'] != 0)
        $errore = true;
    $titolo = $_REQUEST['titolo'];
    if($titolo == "")
        $errore = true;
    $g = $_REQUEST['g_inizio'];
    if(!is_numeric($g))
        $errore = true;
    if($g < 10)
        $g = "0".$g;
    $m = $_REQUEST['m_inizio'];  
    if(!is_numeric($m))
        $errore = true;
    if($m < 10)
        $m = "0".$m;    
    $a = $_REQUEST['a_inizio'];
    if(!is_numeric($a))
        $errore= true;
    $data_inizio = $a."-".$m."-".$g." 00:00:00";
    $gf = $_REQUEST['g_fine'];
    if(!is_numeric($gf))
        $errore = true;
    if($gf < 10)
        $gf = "0".$gf;    
    $mf = $_REQUEST['m_fine'];
    if(!is_numeric($mf))
        $errore = true;
    if($mf < 10)
        $mf = "0".$mf;     
    $af = $_REQUEST['a_fine'];
    if(!is_numeric($af))
        $errore = true;
    $data_fine = $af."-".$mf."-".$gf." 23:59:00";
    $durata = $_REQUEST['durata']*1000;
    if(!is_numeric($durata))
        $errore = true;
    $feed = array($_REQUEST['idfeed']);
    $feed_ids = array_unique(array_values($feed));
    if ($errore == false){
    $uploader = new Uploader($titolo, date($data_inizio), date($data_fine), $feed_ids, $durata, $contenuto, 'banner', $utente->id, 1); 
    if($uploader->retval)
        header("Location: add.php");
    else
        header("Location: error_add.php");
  }else
      header("Location: error_add.php");                     
}else
    include('login.php');         
?>

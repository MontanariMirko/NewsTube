<?php
include('../../config.inc.php');
include(COMMON_DIR.'mysql.inc.php');

$db_host = 'mysql.comune.carpi.mo.it';
$db_login = 'concerto';
$db_password = 'qelpdc';
$db_database = 'concerto';
$link = mysql_pconnect($db_host, $db_login, $db_password);
$db_selected = mysql_select_db($db_database, $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

$mese = date("m");
if($mese == 01){
    $mese = 12;
}else{
    $mese = $mese - 1;
    if($mese < 10)
        $mese = "0".$mese;
}

$query1 = "DELETE newsfeed.* FROM newsfeed,notifications WHERE newsfeed.notification_id=notifications.id AND month(notifications.timestamp) < $mese";
$res1 = mysql_query($query1);
$query2 = "DELETE FROM notifications WHERE month(timestamp) < $mese";
$res2 = mysql_query($query2);
echo "Manutenzione eseguita";
mysql_close($link);
?>

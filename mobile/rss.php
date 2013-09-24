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
<script type="text/javascript" language="JavaScript">
function cancella(val){
val.value="";
}
function crea_rss(notizia, dim, col, tipo){

if(notizia == "0" || dim == "0" || col == "0" || tipo == "0")
          document.getElementById("contenuto").value='<?= $rss_10; ?>';
else{
    if(notizia == "ansa") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/ansait_web_rss_homepage.xml" frameborder="0"></iframe>';
    if(notizia == "ansacro") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/cronaca/cronaca_rss.xml" frameborder="0"></iframe>';    
    if(notizia == "ansascie") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/scienza/scienza_rss.xml" frameborder="0"></iframe>';    
    if(notizia == "ansatop") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/topnews/topnews_rss.xml" frameborder="0"></iframe>';
    if(notizia == "ansaemi") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/regioni/emiliaromagna/emiliaromagna_rss.xml" frameborder="0"></iframe>';
    if(notizia == "repubblica") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://rss.feedsportal.com/c/32275/f/438637/index.rss" frameborder="0"></iframe>';
    if(notizia == "gazmodena") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://gazzettadimodena.gelocal.it/rss/modena.xml" frameborder="0"></iframe>';
    if(notizia == "carlino") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://quotidianohome.feedsportal.com/c/33327/f/565663/index.rss" frameborder="0"></iframe>';
    if(notizia == "carlmod") 
         document.getElementById("contenuto").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://it.ilrestodelcarlino.feedsportal.com/c/33331/f/565708/index.rss" frameborder="0"></iframe>';                                      
  }                     
}
</script>
  </head>  
  <body>     
    <div class="logo">  
      <a href="dashboard.php"><img src="images/conc_bluebg.gif"></a>  
    </div>  
    <div class="menu">  
      <span style=" background-color: #99CCFF">&nbsp;<a href="add.php">Aggiungi</a>&nbsp;</span>&nbsp;&nbsp;     
      <span><a href="mod.php">Modera</a>
  <?
  if($ut['admin_privileges'] == 1 && $more_waiting > 0)
      echo "(".$more_waiting.")";
  elseif($mod_feeds > 0)
      echo "(".$mod_feeds.")";
  ?>
  </span>&nbsp;&nbsp;   
      <span>
        <a href="schermi.php">Schermi</a>
      </span>  
    </div>  
    <div align=center> 
      <form ENCTYPE="multipart/form-data" method="post" action="add_rss.php">
      <b>Aggiungi Feed RSS</b><br><br>
      Rss dal sito<br>
      <select name="notizia" id="notizia" onChange="crea_rss(this.options[this.selectedIndex].value, dim.options[dim.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    <option value="0"> </option>
    <option value="ansa">Ansa (raccomandato)</option>
    <option value="ansacro">Ansa cronaca</option>
    <option value="ansascie">Ansa scienza e medicina</option>
    <option value="ansatop">Ansa topnews</option>
    <option value="ansaemi">Ansa Emilia Romagna</option>  
    <option value="repubblica">Repubblica.it</option>
    <option value="gazmodena">Gazzetta di Modena</option>
    <option value="carlino">Resto del Carlino</option>
    <option value="carlmod">Resto del carlino Modena</option>
    </select><br>
    Carattere<br>
    <select name="tipo" id="tipo" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, dim.options[dim.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, this.options[this.selectedIndex].value);">
    <option value="0"></option>
    <option value="arial"><font face="arial">Arial</font></option>
    <option value="tmr"><font face="Times New Roman">Times New Roman</font></option>
    </select><br>
    Dimensione<br>
    <select name="dim" id="dim" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, this.options[this.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    <option value="0"> </option>
    <option value="1">Grande</option>
    <option value="2">Medio</option>
    <option value="3">Piccolo</option>
    </select> <br>Colore<br>
    <select name="coloretesto" id="coloretesto" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, dim.options[dim.selectedIndex].value, this.options[this.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    <option value="0"> </option>
    <option value="white">Bianco</option>
    <option value="black">Nero</option>
    <option value="red">Rosso</option>
    <option value="blue">Blu</option>
    <option value="green">Verde</option>
    </select><br>
    <div style="DISPLAY: none">
      <textarea name="contenuto" id="contenuto" rows="4" cols="40"></textarea>
      </div> 
      Titolo<br>
      <input type=text name="titolo" id="titolo"><br>
      Data inizio<br>
      <input type=text name="g_inizio" id="g_inizio" size="2" maxlength="2" value="gg" onClick="cancella(this)"> /
      <input type=text name="m_inizio" id="m_inizio" size="2" maxlength="2" value="mm" onClick="cancella(this)"> /
      <input type=text name="a_inizio" id="a_inizio" size="4" maxlength="4" value="aaaa" onClick="cancella(this)"><br>
      Data fine<br>
      <input type=text name="g_fine" id="g_fine" size="2" maxlength="2" value="gg" onClick="cancella(this)"> /
      <input type=text name="m_fine" id="m_fine" size="2" maxlength="2" value="mm" onClick="cancella(this)"> /
      <input type=text name="a_fine" id="a_fine" size="4" maxlength="4" value="aaaa" onClick="cancella(this)"><br>
      Durata (in secondi)<br>
      <input type=text name="durata" id="durata" value="3600"><br>
      Inserisci nel feed<br>
      <select name="idfeed">
      <?
      $sql = "SELECT id, name FROM feed WHERE type=0";
      $res = sql_query($sql);
       for($i = 0;$row = sql_row_keyed($res,$i);++$i){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
       }
      ?>
      </select><br><br>
      <input type=submit name="carica" value="Carica">
      <br><br>
      </form>
    </div>  

  </body>
</html>
<?
 }else
    include('login.php');
?>
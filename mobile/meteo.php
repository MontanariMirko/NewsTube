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
function crea_frame(city, site){
if(city == "0" || site == "0"){
    document.getElementById("contenuto").value=''; 
}
if(city != "0" && site != "0"){
  if(site == "www.ilmeteo.it_es"){
      if(city == "745") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=745&type=day1" frameborder="0"></iframe></p>';
      if(city == "1192") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=1192&type=day1" frameborder="0"></iframe></p>';
      if(city == "1412") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=1412&type=day1" frameborder="0"></iframe></p>';
      if(city == "4114") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=4114&type=day1" frameborder="0"></iframe></p>';
      if(city == "4682") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=4682&type=day1" frameborder="0"></iframe></p>';
      if(city == "4988") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=4988&type=day1" frameborder="0"></iframe></p>';
      if(city == "5688") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=5688&type=day1" frameborder="0"></iframe></p>'; 
      if(city == "6676") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=6677&type=day1" frameborder="0"></iframe></p>'; 
      if(city == "6957") 
         document.getElementById("contenuto").value='<p align=center><iframe width="500" height="259" scrolling="no" src="http://www.ilmeteo.it/box/previsioni.php?citta=6958&type=day1" frameborder="0"></iframe></p>';                      
  }
  if(site == "www.ilmeteo.it_rid"){
      if(city == "745")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=745&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "1192")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=1192&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "1412")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=1412&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4114")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=4114&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4682")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=4682&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4988")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=4988&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "5688")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=5688&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "6676")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=6677&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "6957")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://www.ilmeteo.it/box/previsioni.php?citta=6958&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';                                                                                                              
  }
  if(site == "www.3bmeteo.com"){
      if(city == "745")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=745&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "1192")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=1192&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "1412")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=1412&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4114")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=4114&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4682")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=4682&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4988")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=4988&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "5688")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=5688&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "6676")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=6676&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "6957")
          document.getElementById("contenuto").value='<p align=center><iframe src="http://portali.3bmeteo.com/3bm_meteo.php?loc=6957&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';                                                                                                              
  }
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
      <form ENCTYPE="multipart/form-data" method="post" action="add_meteo.php">
      <b>Aggiungi Meteo</b><br><br>
      Citt&agrave; visualizzata<br>
      <select name="citta" id="citta" onChange="crea_frame(this.options[this.selectedIndex].value,sito.options[sito.selectedIndex].value);">
     <option value="0"></option>
     <option value="745">Bologna</option>
     <option value="1192">Campogalliano</option>
     <option value="1412">Carpi</option>
     <option value="4114">Modena</option> 
     <option value="4682">Novi</option>
     <option value="4988">Parma</option>
     <option value="5688">Reggio Emilia</option>
     <option value="6676">Sassuolo</option>
     <option value="6957">Soliera</option>
  </select><br>Dal sito<br>
  <select name="sito" id="sito" onChange="crea_frame(citta.options[citta.selectedIndex].value,this.options[this.selectedIndex].value);">
    <option value="0"></option>
    <option value="www.ilmeteo.it_es">www.ilmeteo.it esteso</option>
    <option value="www.ilmeteo.it_rid">www.ilmeteo.it ridotto</option>
    <option value="www.3bmeteo.com">www.3bmeteo.com</option>
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
      <input type=text name="durata" id="durata" value="5"><br>
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
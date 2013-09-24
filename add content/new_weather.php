<?php
$lang = $_SESSION['language'];
require(LANGUAGE_DIR . "{$lang}.php");
?>

<script type="text/javascript">
function crea_frame(city, site){
if(city == "0" || site == "0"){
    document.getElementById("weather").value=''; 
}
if(city != "0" && site != "0"){
  if(site == "www.ilmeteo.it_es"){
      if(city == "745") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=745&type=day1" frameborder="0"></iframe></p>';
      if(city == "1192") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=1192&type=day1" frameborder="0"></iframe></p>';
      if(city == "1412") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=1412&type=day1" frameborder="0"></iframe></p>';
      if(city == "4114") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=4114&type=day1" frameborder="0"></iframe></p>';
      if(city == "4682") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=4682&type=day1" frameborder="0"></iframe></p>';
      if(city == "4988") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=4988&type=day1" frameborder="0"></iframe></p>';
      if(city == "5688") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=5688&type=day1" frameborder="0"></iframe></p>'; 
      if(city == "6676") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=6677&type=day1" frameborder="0"></iframe></p>'; 
      if(city == "6957") 
         document.getElementById("weather").value='<p align=center><iframe width="500" height="259" scrolling="no" src="/ilmeteoit/box/previsioni.php?citta=6958&type=day1" frameborder="0"></iframe></p>';                      
  }
  if(site == "www.ilmeteo.it_rid"){
      if(city == "745")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=745&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "1192")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=1192&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "1412")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=1412&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4114")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=4114&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4682")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=4682&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "4988")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=4988&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "5688")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=5688&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "6676")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=6677&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';
      if(city == "6957")
          document.getElementById("weather").value='<p align=center><iframe src="/ilmeteoit/box/previsioni.php?citta=6958&type=real1&width=200&ico=3&lang=ita&days=6&font=Tahoma&fontsize=10&bg=0099FF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=000000" width="200" height="100" frameborder="0" scrolling="no"></iframe></p>';                                                                                                              
  }
  if(site == "www.3bmeteo.com"){
      if(city == "745")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=745&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "1192")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=1192&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "1412")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=1412&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4114")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=4114&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4682")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=4682&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "4988")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=4988&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "5688")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=5688&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "6676")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=6676&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';
      if(city == "6957")
          document.getElementById("weather").value='<p align=center><iframe src="/3bmeteocom/3bm_meteo.php?loc=6957&tm=lsmall&new=1" width="195" height="340" frameborder="0"></iframe></p>';                                                                                                              
  }
}
}

function vedicodmeteo(cw){
var txt = document.getElementById("codicemeteo");
if(cw.checked)
  txt.style.display = 'block';
else
  txt.style.display = 'none';
}

</script>

<div style="height:220px; width:330px; float:left;">
	<img src="<?= ADMIN_BASE_URL ?>images/weather_icon.png" alt="" />
</div>
<h1 class="addcontent"><?= $weather_2; ?></h1>
<h2><?= $weather_3; ?></h2>
<div style="clear:both;"></div>
<form enctype="multipart/form-data" method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $weather_4; ?></h5><p><b><?= $weather_5; ?></b></p></td>
  <td class="edit_col"> 
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
  </select>
  </td>
  </tr>
  <tr>
  <td><h5><?= $weather_6; ?></h5><p><b><?= $weather_11; ?></b></p></td>
  <td class="edit_col"> 
  <select name="sito" id="sito" onChange="crea_frame(citta.options[citta.selectedIndex].value,this.options[this.selectedIndex].value);">
    <option value="0"></option>
    <option value="www.ilmeteo.it_es">www.ilmeteo.it<?= $weather_9; ?></option>
    <option value="www.ilmeteo.it_rid">www.ilmeteo.it<?= $weather_10; ?></option>
    <option value="www.3bmeteo.com">www.3bmeteo.com</option>
  </select>
  </td></tr>
  <tr>
  <td><h5><?= $weather_8; ?><input type=checkbox name=codmeteo id=codmeteo onClick="vedicodmeteo(this)"></h5></td>
  <td class="edit_col"> 
  <div id=codicemeteo style="DISPLAY: none">
  <p><?= $weather_7; ?></p>
  <textarea name="content[content]" id="weather" rows="5" cols="40"></textarea>
  </div>
    <br /><br />
    <input name="content[upload_type]" value="weather" type="hidden" />
      </td>
  </tr>
</table>
<br />
<?php
   include("rssform.php");
?>
<input value="Carica contenuto" type="submit" name="submit" />
</form>

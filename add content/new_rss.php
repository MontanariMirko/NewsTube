<?php
/**
 * This file was developed as part of the NewsTube digital signage project
 * at RPI.
 *
 * Copyright (C) 2009 Rensselaer Polytechnic Institute
 * (Student Senate Web Technologies Group)
 *
 * This program is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.  You should have received a copy
 * of the GNU General Public License along with this program.
 *
 * @package      NewsTube
 * @author       Web Technologies Group, $Author: brian $
 * @copyright    Rensselaer Polytechnic Institute
 * @license      GPLv2, see www.gnu.org/licenses/gpl-2.0.html
 * @version      $Revision: 672 $
 */
 
       $lang = $_SESSION['language'];
require(LANGUAGE_DIR . "{$lang}.php");

?>
<script type="text/javascript">
function crea_rss(notizia, dim, col, tipo){    
  
var linksito = document.getElementById("linksito").value; 
 
if(linksito != "")
    notizia = linksito;  
if(notizia == "0" || dim == "0" || col == "0" || tipo == "0")
          document.getElementById("feedrss").value='';
else{
    if(notizia == "ansa") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/ansait_web_rss_homepage.xml" frameborder="0"></iframe>';
    else if(notizia == "ansacro") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/cronaca/cronaca_rss.xml" frameborder="0"></iframe>';    
    else if(notizia == "ansascie") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/scienza/scienza_rss.xml" frameborder="0"></iframe>';    
    else if(notizia == "ansatop") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/rubriche/topnews/topnews_rss.xml" frameborder="0"></iframe>';
    else if(notizia == "ansaemi") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://ansa.it/web/notizie/regioni/emiliaromagna/emiliaromagna_rss.xml" frameborder="0"></iframe>';
    else if(notizia == "repubblica") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://rss.feedsportal.com/c/32275/f/438637/index.rss" frameborder="0"></iframe>';
    else if(notizia == "gazmodena") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://gazzettadimodena.gelocal.it/rss/modena.xml" frameborder="0"></iframe>';
    else if(notizia == "carlino") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://quotidianohome.feedsportal.com/c/33327/f/565663/index.rss" frameborder="0"></iframe>';
    else if(notizia == "carlmod") 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito=http://it.ilrestodelcarlino.feedsportal.com/c/33331/f/565708/index.rss" frameborder="0"></iframe>';
    else 
         document.getElementById("feedrss").value='<iframe width="800" height="80" scrolling="no" src="<?= ROOT_URL ?>rss.php?dim='+dim+'&col='+col+'&tipo='+tipo+'&sito='+notizia+'" frameborder="0"></iframe>';                                            
  }                     
}

function vedicodice(cc){
var tx = document.getElementById("codicerss");
if(cc.checked)
  tx.style.display = 'block';
else
  tx.style.display = 'none';
}

</script>

<div style="height:220px; width:330px; float:left;">
	<img src="<?= ADMIN_BASE_URL ?>images/rss_icon.png" alt="" />
</div>
<h1 class="addcontent"><?= $rss_1; ?></h1>
<h2><?= $rss_2; ?></h2>
<div style="clear:both;"></div>
<form method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $rss_3; ?></h5><p><b><?= $rss_4; ?></b></p></td>
  <td class="edit_col">
  <table border=0>
  <tr><td style="border:0px">
    <?= $rss_20; ?>
    </td><td style="border:0px"><select name="notizia" id="notizia" onChange="crea_rss(this.options[this.selectedIndex].value, dim.options[dim.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
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
    </select></td>
    </tr><tr><td style="border:0px">
    <?= $rss_19; ?></td><td style="border:0px"><input type=text style="width:300" id="linksito" onKeyUp="crea_rss(notizia.options[notizia.selectedIndex].value, dim.options[dim.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    </td></tr></table>
    </td>
    </tr>
    <tr>
    <td><h5><?= $rss_21; ?></h5><p><b><?= $rss_22; ?></b></p></td>
    <td class="edit_col">
    <table border=0>
    <tr><td  style="border:0px">
    <?= $rss_18; ?></td><td style="border:0px">
    <select name="tipo" id="tipo" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, dim.options[dim.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, this.options[this.selectedIndex].value);">
    <option value="0"></option>
    <option value="arial"><font face="arial">Arial</font></option>
    <option value="tmr"><font face="Times New Roman">Times New Roman</font></option>
    </select></td></tr>
    <tr><td style="border:0px">
    <?= $rss_6; ?></td><td style="border:0px">
    <select name="dim" id="dim" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, this.options[this.selectedIndex].value, coloretesto.options[coloretesto.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    <option value="0"> </option>
    <option value="1"><?= $rss_7; ?></option>
    <option value="2"><?= $rss_8; ?></option>
    <option value="3"><?= $rss_9; ?></option>
    </select></td></tr>
    <tr><td style="border:0px">
    <?= $rss_12; ?></td><td style="border:0px">
    <select name="coloretesto" id="coloretesto" onChange="crea_rss(notizia.options[notizia.selectedIndex].value, dim.options[dim.selectedIndex].value, this.options[this.selectedIndex].value, tipo.options[tipo.selectedIndex].value);">
    <option value="0"> </option>
    <option value="white"><?= $rss_13; ?></option>
    <option value="black"><?= $rss_14; ?></option>
    <option value="red"><?= $rss_15; ?></option>
    <option value="blue"><?= $rss_16; ?></option>
    <option value="green"><?= $rss_17; ?></option>
    </select></td></tr></table>
    </td>
    </tr>
    <tr>
    <td><h5><?= $rss_11; ?><input type=checkbox name=code id=code onClick="vedicodice(this)"></h5></td> 
    <td class="edit_col">   
    <div id=codicerss style="DISPLAY: none">
    <p><?= $rss_5; ?></p>
    <textarea name="content[content]" id="feedrss" rows="5" cols="40" display="none"></textarea>
    </div>
    <input name="content[upload_type]" value="rss" type="hidden" />
  </td>
  </tr>
</table>
<br />
<?php 
   include("rssform.php");
?>
<input value="<?= $ticker_7; ?>" type="submit" name="submit" />
</form>

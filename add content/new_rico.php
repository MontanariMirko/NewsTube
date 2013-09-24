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
function crea_rico(rico, tipo, col, dim){
var w = document.getElementById("w").value;
var h = document.getElementById("h").value;
var w_frame = parseInt(w) + 10;
var h_frame = parseInt(h) + 10;

if(rico == "0" || col == "0" || tipo == "0" || w == "" || h == "" || dim == "")
          document.getElementById("feedrico").value='';
else{
    if(rico == "rico") 
         document.getElementById("feedrico").value='<iframe width="'+w_frame+'" height="'+h_frame+'" scrolling="no" src="<?= ROOT_URL ?>wiki.php?tipo='+tipo+'&col='+col+'&w='+w+'&h='+h+'$dim='+dim+'" frameborder="0"></iframe>';
    if(rico == "nati") 
         document.getElementById("feedrico").value='<iframe width="'+w_frame+'" height="'+h_frame+'" scrolling="no" src="<?= ROOT_URL ?>nati.php?tipo='+tipo+'&col='+col+'&w='+w+'&h='+h+'$dim='+dim+'" frameborder="0"></iframe>';    
    if(rico == "morti") 
         document.getElementById("feedrico").value='<iframe width="'+w_frame+'" height="'+h_frame+'" scrolling="no" src="<?= ROOT_URL ?>morti.php?tipo='+tipo+'&col='+col+'&w='+w+'&h='+h+'$dim='+dim+'" frameborder="0"></iframe>';    
  }                     
}

function guardacodice(cc){
var tx = document.getElementById("codicerico");
if(cc.checked)
  tx.style.display = 'block';
else
  tx.style.display = 'none';
}

</script>

<div style="height:220px; width:330px; float:left;">
	<img src="<?= ADMIN_BASE_URL ?>images/rico_icon.jpg" alt="" />
</div>
<h1 class="addcontent"><?= $rico_1; ?></h1>
<h2><?= $rico_2; ?></h2>
<div style="clear:both;"></div>
<form method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $rico_3; ?></h5><p><b><?= $rico_4; ?></b></p></td>
  <td class="edit_col">
    <select name="ricotext" id="ricotext" onChange="crea_rico(this.value, typetxt.value, colortext.value, dimensione.value);">
    <option value="0"> </option>
    <option value="rico"><?= $rico_14; ?></option>
    <option value="nati"><?= $rico_15; ?></option>
    <option value="morti"><?= $rico_16; ?></option>
    </select>
    </td>
    </tr>
    <tr>
    <td><h5><?= $rico_26; ?></h5><p><b><?= $rico_27; ?></b></p></td>
    <td class="edit_col">
    <table border=0>
    <tr><td style="border:0px">
    <?= $rico_13; ?></td><td style="border:0px">
    <select name="typetxt" id="typetxt" onChange="crea_rico(ricotext.value, this.value, colortext.value, dimensione.value);">
    <option value="0"></option>
    <option value="arial"><font face="arial">Arial</font></option>
    <option value="tmr"><font face="Times New Roman">Times New Roman</font></option>
    </select></td></tr>
    <tr><td style="border:0px"><?= $rico_8; ?></td><td style="border:0px">
    <select name="colortext" id="colortext" onChange="crea_rico(ricotext.value, typetxt.value, this.value, dimensione.value);">
    <option value="0"> </option>
    <option value="white"><?= $rico_9; ?></option>
    <option value="black"><?= $rico_10; ?></option>
    <option value="blue"><?= $rico_11; ?></option>
    <option value="green"><?= $rico_12; ?></option>
    </select></td></tr>
    <tr><td style="border:0px"><?= $rico_19; ?></td><td style="border:0px">
    <select name="dimensione" id="dimensione" onChange="crea_rico(ricotext.value, typetxt.value, colortext.value, this.value);">
    <option value=""></option>
    <option value="1"><?= $rico_20; ?></option>
    <option value="2"><?= $rico_21; ?></option>
    <option value="3"><?= $rico_22; ?></option>
    <option value="4"><?= $rico_23; ?></option>
    <option value="5"><?= $rico_24; ?></option>
    <option value="6"><?= $rico_25; ?></option>
    </select></td></tr></table>
    </td>
    </tr>
    <tr>
    <td><h5><?= $rico_28; ?></h5><p><b><?= $rico_29; ?></b></p></td>
    <td class="edit_col">
    <table border=0>
    <tr><td style="border:0px">
    <?= $rico_17; ?></td><td style="border:0px">
    <input type=text name="w" id="w" value="450" style="width:40px;" onKeyUp="crea_rico(ricotext.options[ricotext.selectedIndex].value, typetxt.options[typetxt.selectedIndex].value, colortext.options[colortext.selectedIndex].value);">
    </td></tr><tr><td style="border:0px"><?= $rico_18 ?></td><td style="border:0px">
    <input type=text name="h" id="h" value="330" style="width:40px;" onKeyUp="crea_rico(ricotext.options[ricotext.selectedIndex].value, typetxt.options[typetxt.selectedIndex].value, colortext.options[colortext.selectedIndex].value);">    
    </td></tr></table></td>
    </tr>
    <tr>
    <td><h5><?= $rico_7; ?><input type=checkbox name=codewiki id=codewiki onClick="guardacodice(this)"></h5></td>
    <td class="edit_col">
    <div id=codicerico style="DISPLAY: none">
    <p><?= $rico_5; ?></p>
    <textarea name="content[content]" id="feedrico" rows="5" cols="40" display="none"></textarea>
    </div>
    <input name="content[upload_type]" value="rico" type="hidden" />
  </td>
  </tr>
</table>
<br />
<?php 
   include("rssform.php");
?>
<input value="<?= $ticker_7; ?>" type="submit" name="submit" />
</form>

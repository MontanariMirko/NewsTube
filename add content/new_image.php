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
 * @version      $Revision: 558 $
 */
     $lang = $_SESSION['language'];
require(LANGUAGE_DIR . "{$lang}.php");

?><div style="height:220px; width:330px; float:left;">
	<img src="<?= ADMIN_BASE_URL ?>images/graphic_icon.jpg" alt="" />
</div>
<h1 class="addcontent"><?= $image1_1; ?></h1>
<h2><?= $image1_2; ?></h2>
<h2><?= $image1_3; ?><a TARGET="_blank" href="<?= ADMIN_URL ?>/guida/immagine"><?= $image1_4; ?></a><?= $image1_5; ?></h2>
<div style="clear:both;"></div>
<form enctype="multipart/form-data" method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $image1_6; ?></h5><p><b><?= $image1_7; ?></b></p></td>
  <td class="edit_col">
    <input name="content_file" class="extended" type="file" />
    <br /><br />
    <p><?= $image1_8; ?> JPEG, PNG, GIF</p>
    <input name="content[upload_type]" value="file" type="hidden" />
  </td>
  </tr>
</table>
<br />
<?php
   include("_form.php");
?>
<input value="<?= $image1_10; ?>" type="submit" name="submit" />
</form>

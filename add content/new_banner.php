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
	<img src="<?= ADMIN_BASE_URL ?>images/banner_icon.jpg" alt="" />
</div>
<h1 class="addcontent"><?= $banner_1; ?></h1>
<h2><?= $banner_2; ?></h2>
<div style="clear:both;"></div>
<form enctype="multipart/form-data" method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $banner_3; ?></h5><p><b><?= $banner_4; ?></b></p></td>
  <td class="edit_col">
    <input name="content_file" class="extended" type="file" />
    <br /><br />
    <p><?= $banner_5; ?> JPEG, PNG, GIF<br /></p>
    <input name="content[upload_type]" value="banner" type="hidden" />
  </td>
  </tr>
</table>
<br />
<?php
   include("_form.php");
?>
<input value="<?= $banner_6; ?>" type="submit" name="submit" />
</form>

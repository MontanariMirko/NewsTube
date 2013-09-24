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

?><div style="height:220px; width:330px; float:left;">
	<img src="<?= ADMIN_BASE_URL ?>images/ticker_icon.jpg" alt="" />
</div>
<h1 class="addcontent"><?= $ticker_1; ?></h1>
<h2><?= $ticker_2; ?></h2>
<div style="clear:both;"></div>
<form method="post" action="<?=ADMIN_URL?>/content/create">
<br /><br /><table class='edit_win' style="margin-top:-18px" cellpadding='6' cellspacing='0'>
  <tr>
  <td><h5><?= $ticker_3; ?></h5><p><b><?= $ticker_4; ?></b></p></td>
  <td class="edit_col">
    <textarea name="content[content]" id="content" rows="3" cols="40"></textarea>
    <input name="content[upload_type]" value="text" type="hidden" />
    <p id="content_count" class="content_msg"><?= $ticker_5; ?><?= TICKER_LIMIT ?><?= $ticker_6; ?></p>
  </td>
  </tr>
</table>
<br />
<?php 
   include("_form.php");
?>
<input value="<?= $ticker_7; ?>" type="submit" name="submit" />
</form>

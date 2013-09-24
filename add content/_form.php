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
 * @version      $Revision: 712 $
 */
$lang = $_SESSION['language'];
require(LANGUAGE_DIR . "{$lang}.php");
 
   //assuming $this->screen is null or the screen we want to edit
   if(array_key_exists('content',$this)) {
      $content = $this->content;
   } else {
      $content = new Content();
   }
?>
<!-- Begin Content Form -->
     <table class='edit_win' cellpadding='6' cellspacing='0'>
       <tr>
         <td><h5><?= $form1_1; ?></h5><p><?= $form1_2; ?></p></td>
         <td colspan="2" class='edit_col'>
           <input type="text" class="extended" name="content[name]" value="<?=$content->name?>" />
         </td>
       </tr>
       <tr>
         <td><h5><?= $form1_3; ?></h5><p><?= $form1_4; ?></p></td>
         <td>
           <input type="text" class="start_date" name="content[start_date]" value="<?=$content->start_time?>" />
           <p class="start_time_msg"><?= $form1_5; ?> (00:00am)</p>
         </td>
         <td width="30%" style="text-align:right;"><a class="click_start_time" href="#"><?= $form1_6; ?></a>
           <div class="start_time_select" style="text-align:right;display:none"><?= $form1_7; ?>:
           <select name="content[start_time]">
<?php
      echo "<option value=\"00:00\" selected=\"selected\">12:00am</option>\n";
      echo "<option value=\"00:30\">12:30am</option>\n";
      for ($i = 1; $i < 12; $i ++)
      {
         $tempi = str_pad($i, 2, "0", STR_PAD_LEFT);
         echo "<option value=\"{$tempi}:00\">{$i}:00am</option>\n";
         echo "<option value=\"{$tempi}:30\">{$i}:30am</option>\n";
      }
      echo "<option value=\"12:00\">12:00pm</option>\n";
      echo "<option value=\"12:30\">12:30pm</option>\n";
      for ($i = 1; $i < 12; $i ++)
      {
         $tempi = str_pad($i, 2, "0", STR_PAD_LEFT);
         $rtime = $i+12;
         echo "<option value=\"{$rtime}:00\">$i:00pm</option>\n";
         echo "<option value=\"{$rtime}:30\">$i:30pm</option>\n";
      }
      echo "<option value=\"23:59\">11:59pm</option>\n";
?>
           </select>
           </div>
         </td>
       </tr>

       <tr>
         <td><h5><?= $form1_8; ?></h5><p><?= $form1_9; ?></p></td>
         <td>
           <input type="text" class="end_date" name="content[end_date]" value="<?=$content->end_time?>" />
           <p class="end_time_msg"><?= $form1_10; ?></p>
         </td>
         <td width="30%" style="text-align:right;"><a class="click_end_time" href="#"><?= $form1_11; ?></a>
           <div class="end_time_select" style="text-align:right;display:none"><?= $form1_12; ?>
           <select name="content[end_time]">
<?php
      echo "<option value=\"00:00\">12:00am</option>\n";
      echo "<option value=\"00:30\">12:30am</option>\n";
      for ($i = 1; $i < 12; $i += 1)
      {
         $tempi = str_pad($i, 2, "0", STR_PAD_LEFT);
         echo "<option value=\"{$tempi}:00\">{$i}:00am</option>\n";
         echo "<option value=\"{$tempi}:30\">{$i}:30am</option>\n";
      }
      echo "<option value=\"12:00\">12:00pm</option>\n";
      echo "<option value=\"12:30\">12:30pm</option>\n";
      for ($i = 1; $i < 12; $i += 1)
      {
         $tempi = str_pad($i, 2, "0", STR_PAD_LEFT);
         $rtime = $i+12;
         echo "<option value=\"{$rtime}:00\">$i:00pm</option>\n";
         echo "<option value=\"{$rtime}:30\">$i:30pm</option>\n";
      }
      echo "<option value=\"23:59\" selected=\"selected\">11:59pm</option>\n";
?>
           </select>
           </div>
         </td>
       </tr>

       <tr>
         <td><h5><?= $form1_13; ?></h5><p><?= $form1_14; ?></p></td>
         <td>
           <div class="duration_msg"><?= $form1_15; ?><?=DEFAULT_DURATION?><?= $form1_16; ?></div>
           <div class="duration_div" style="display:none"><input type="text" size="2" name="content[duration]" value="<?= DEFAULT_DURATION ?>" /> <?= $form1_16; ?></div>
         </td>
         <td width="30%" style="text-align:right;"><a class="click_duration" href="#"><?= $form1_17; ?></a>
         </td>
       </tr>
     </table>
     <!--<br /><br />
     <h2>Not sure what feeds are?  <a TARGET="_blank" href="<?= ADMIN_URL ?>/pages/show/docs/23">Read this first!</a></h2>-->
     <table class='edit_win' cellpadding='6' cellspacing='0'>
       <tr>
         <td>
           <div style="float:right;"><a class="click_add_feed" href="#"><?= $form1_18; ?></a></div>
           <h5><?= $form1_19; ?></h5>
           <p><b><?= $form1_20; ?></b></p>
           <br/>
           <div class="feeddiv">
             <div style="float:left; width:38%;">
               <select class="feedsel" name="content[feeds][0]"
                       onChange="">
                 <option title=" " class="feedopt"> </option>
<?php
foreach ($this->feeds as $arr) {
    list($feed, $value) = $arr;
    $screens = array();
    $screen_objs = $feed->get_screens($content_type);
    if(is_array($screen_objs) && count($screen_objs)>0) {
      foreach($screen_objs as $screen) {
        $screens[] = $screen->name;
      }
    }
    $scrcnt = count($screens);
?>
                 <option class="feedopt"
                   title="<?= $form1_21; ?><?=$scrcnt?><?= $form1_22; ?>" 
                   value="<?=$feed->id?>"><?=htmlspecialchars($feed->name)?></option>

<? } ?>
               </select>
             </div>
             <div style="float:right; width:58%;" class="feeddesc"><p> </p></div>
             <div style="clear:both;"></div>
           </div>
         </td>
       </tr>
     </table>
   <br clear="all" />
<!-- End Screen Form General Section -->

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

?><script type="text/javascript"><!--
(function($) {
    $(document).ready(function() {
        $("ul#maintab").tabs();

        $.datepicker.setDefaults({showOn: 'both',
                                  buttonImageOnly: true,
                                  buttonImage: '<?= ADMIN_BASE_URL ?>images/cal_icon.gif',
                                  buttonText: 'Calendar',
                                  showAnum: "fadeIn"});

        $(".start_date").datepicker();

        $(".end_date").datepicker();

        $(".click_start_time").click(function() {
            $(this).hide().parents("table")
                .find(".start_time_select").show()
                .parents("table")
                .find(".start_time_msg").hide();
            return false;
        });

        $(".click_end_time").click(function() {
            $(this).hide().parents("table")
                .find(".end_time_select").show()
                .parents("table")
                .find(".end_time_msg").hide();
            return false;
        });

        $(".click_duration").click(function() {
            $(this).hide().parents("table")
                .find(".duration_div").show()
                .parents("table")
                .find(".duration_msg").hide();
            return false;
        });

        $(".feedsel").each(function() {
              var desc=$(this).find("option:selected").attr('title');
              $(this).parents(".feeddiv").find(".feeddesc").data("desc", desc);
              update($(this),desc);
           });

        $(".feedopt").mouseover(function() {
              update($(this),$(this).attr('title'));
           });

        $(".feedopt").mouseout(function() {
              update($(this),$(this).parents(".feeddiv").find(".feeddesc").data("desc"));
           });

        $(".feedsel").change(function() {
              var desc=$(this).find("option:selected").attr('title');
              $(this).parents(".feeddiv").find(".feeddesc").data("desc", desc);
              update($(this),desc);
           });

        $(".feedsel").keyup(function() {
              var desc=$(this).find("option:selected").attr('title');
              $(this).parents(".feeddiv").find(".feeddesc").data("desc", desc);
              update($(this),desc);
           });

        $("#content").keyup(function() {
              var length = $(this).val().length;
              var limit = <?= TICKER_LIMIT ?>;
              if( length > limit ) {
                  $(this).val($(this).val().substring(0, limit));
                  return false;
              }
              $(this).siblings(".content_msg").html((limit - $(this).val().length) + "<?= $new1_1; ?>");
              return true;
           });

        update_all($("#maincontent"));

        function update_all(parent) {
           $(parent).find(".feedsel").each(function() {
                 update($(this),$(this).find("option:selected").attr('title'));
              });
        }

        function update(child, desc) {
           var descdiv = $(child).parents('.feeddiv').find('.feeddesc');
           descdiv.html('');
           if(desc.length>0) {
              var pars = desc.split('   ');
              descdiv.append($('<p>').html(pars[0]));
              if(pars.length > 1) {
	              descdiv.append($('<p>').addClass('feeddesc_screens').html(pars[1]));
	            }
           }           //$(child).parents('.feeddiv').find('.feeddesc').html(desc);
        }

        $(".click_add_feed").click(function() {
            var button = $(this);
            var count = button.data("count");
            if(count == undefined)
                count = 0;
            var feeddiv = $(this).parents("tr").find(".feeddiv:last");
            $("<p class='yieldstop'>").html("<b><?= $new1_2; ?></b>  <br /><br /><?= $new1_3; ?>")
                .dialog({
                    autoResize: true,
                    buttons: {
                            "<?= $new1_6; ?>": function(){
                               $(this).dialog("destroy");
                                var select = $(feeddiv).find(".feedsel:first");
                                if(count < $(select).children().length - 2) {
                                    var newdiv = $(feeddiv).clone(true);
                                    $(newdiv).find(".feedsel:first").attr("name","content[feeds][" + ++count + "]");
                                    $(newdiv).find(".feeddesc").html('');
                                    $(newdiv).insertAfter(feeddiv);
                                }
                                button.data("count", count);
                            },
                            "No": function(){ $(this).dialog("destroy"); }
                        },
                    draggable: false,
                    height: "auto",
                    modal: true,
                    overlay: { opacity: 0.5, background: "black" },
                    resizable: false,
                    title: "<?= $new1_7; ?>"
            });
            return false;
        });
    });
})(jQuery);
//--></script>
<ul id="maintab">
    <li class="first"><a class="graphic" href="#new_image"><h1><?= $new1_8; ?></h1></a></li>
	  <li class="middle"><a class="ticker" href="#new_ticker"><h1><?= $new1_9; ?></h1></a></li>
	  <li class="middle"><a class="rss" href="#new_rss"><h1>Feed RSS</h1></a></li>
	  <li class="middle"><a class="rico" href="#new_rico"><h1><?= $new1_12; ?></h1></a></li>
	  <li class="middle"><a class="banner" href="#new_banner"><h1>Banner</h1></a></li>
  <li class="last"><a class="weather" href="#new_weather"><h1><?= $new1_11; ?></h1></a></li>
</ul>
<br class="funkybreak" />
<div class="roundcont">
	<div class="roundtop"><span class="rt"><img src="<? echo ADMIN_BASE_URL ?>/images/blsp.gif" height="6" width="1" alt="" /></span></div>
	<div class="roundcont_main">
		<div id="new_image" class="contentstyle">
         <? $content_type = 3; // for displaying feed subscription info ?>
			<? include("new_image.php"); ?>
		</div>
		<div id="new_ticker" class="contentstyle">
         <? $content_type = 2; // for displaying feed subscription info ?>
			<? include("new_ticker.php"); ?>
		</div>
		<div id="new_rss" class="contentstyle">
         <? $content_type = 6; // for displaying feed subscription info ?>
			<? include("new_rss.php"); ?>
		</div>
		<div id="new_rico" class="contentstyle">
         <? $content_type = 8; // for displaying feed subscription info ?>
			<? include("new_rico.php"); ?>
		</div>
		<div id="new_banner" class="contentstyle">
         <? $content_type = 7; // for displaying feed subscription info?>
			<? include("new_banner.php"); ?>
		</div>
		<div id="new_weather" class="contentstyle">
		<? $content_type = 5; // for displaying feed subscription info ?>
		  <?php include("new_weather.php"); ?>
		</div>
      <div id="new_dynamic" class="contentstyle">
			<?
			if($_SESSION['user']->has_ndc_rights())
			{
            $content_type = NULL; //hmm.
				include("new_dynamic.php"); 
			}
			?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="roundbottom"><span class="rb"><img src="<? echo ADMIN_BASE_URL ?>/images/blsp.gif" height="6" width="1" alt="" /></span></div>
</div>


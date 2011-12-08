<?php slot('title', sprintf('Akademie Syrinx - %s', 'Kalender')) ?>
<?php use_helper('Date') ?>

<h1>Kalender</h1>
<script type="text/javascript">
$(document).ready(function() {
  $('#largeImageDiv').center();   
  $('#largeImageDiv').css("border-style","none");
  $('#largeImageDiv').css("border", "0px");
});
$(function() {
      $('#preview img').click(function() {
            var src = $(this).attr('src').replace('thumb_', '');
            $('#largeImage').attr('src', src).show(0, "fast", function() {
                         $('#largeImageDiv').center();
                    });
      });
      $('#largeImage').hide().click(function() {
            $('#largeImageDiv').css("border-style","none");
            $('#largeImageDiv').css("border", "0px");
            $(this).hide();
      });
});

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
    this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
    this.css("border", "6px");
    this.css("border-color", "#CCCCCC");
    this.css("border-style","solid");
    return this;
}

</script>

<div id="largeImageDiv" style=""><img style="cursor:pointer;cursor:hand" id="largeImage" class="largephoto" src="" title="Hier klicken, um das Bild wieder zu verkleinern" /> </div>

<div id="calendar">
    <?php if(count($syrinx_calendar) == 0) echo "Keine Einträge" ?>
    <?php foreach ($syrinx_calendar as $i => $calendarentry): ?>

		<table style="width:770px">		
      <tr>		
    <td style="vertical-align:top" width="100%">
      <?php echo format_date($calendarentry->getDate(), "EEEE, dd. MMMM yyyy") ?><br />
      <h2><?php echo $calendarentry->getTitle() ?></h2>
      <?php echo $calendarentry->getTime() ?><br /> 
      <?php echo $calendarentry->getVenue() ?> 
      <?php if(!is_null($calendarentry->getMap())): ?>
      &nbsp;&nbsp;&nbsp;<a href="<?php echo $calendarentry->getMap() ?>" target="_blank"><img src="<?php echo image_path('show_on_map.gif') ?>" alt="Karte" /> Karte</a>
      <?php endif ?>
      <br /><br />
      <table class="info" cellpadding="0" cellspacing="0">
      <?php if(!is_null($calendarentry->getDescription()) ) : ?>
        <tr>
        <td>Beschreibung:</td><td class="value"><?php echo $calendarentry->getDescription() ?></td>
	     </tr>     
      <?php endif ?>
      
      <?php if(!is_null($calendarentry->getParticipants()) ) : ?>
        <tr>
        <td>Mitwirkende:</td><td class="value"><?php echo $calendarentry->getParticipants() ?></td>
        </tr>
      <?php endif ?>
      </table>
      </td>
 		<?php 
                   $img = $calendarentry->getImage();
                   if(!empty($img)) : ?>
		<td style="padding-left:25px;vertical-align:top;text-align:right">
                     <div id="preview">
		   <img src="<?php echo '/uploads/calendar/images/'.$calendarentry->getThumbImage() ?>" title="Für vergrösserte Ansicht bitte klicken" style="cursor:pointer;cursor:hand" border="0"/>
                    </div>
		   </td>
      <?php endif ?>    
      </tr>
      </table>
      <br />
      <?php if($calendarentry->hasInfos()) : ?> 
      <h4>Weitere Informationen:</h4>
      <blockquote>
      <?php foreach ($calendarentry->getFiles() as $name => $path): ?>   
      <span class="option">—</span><a href="<?php echo '/uploads/calendar/files/'.$path ?>"><?php echo $name ?></a>&nbsp;&nbsp;&nbsp;<span class="doctype">[PDF]</span><br />
      <?php endforeach ?>
      <?php foreach ($calendarentry->getLinks() as $name => $uri): ?>   
      <?php
        $href = trim($uri);
        if(substr(strtolower($href), 0, 4) == "www.") { 
          $href = "http://".$href;
        }
      ?>
      <span class="option">—</span><a target="_blank" href="<?php echo $href ?>"><?php echo $name ?></a>&nbsp;&nbsp;&nbsp;<span class="doctype">[WWW]</span><br />
      <?php endforeach ?>
      </blockquote>
      <?php endif ?>    
<?php if( $i < count($syrinx_calendar) - 1 ): ?>
	<div class="separator"></div><br/>
<?php endif ?>
    <?php endforeach ?>
</div>

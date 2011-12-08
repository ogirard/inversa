<?php slot('title', sprintf('Akademie Syrinx - %s', 'Projekte')) ?>
<h1>Projekte</h1>
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

<div id="projects">
    <?php if(count($syrinx_projects) == 0) echo "Keine Einträge" ?>
    <?php foreach ($syrinx_projects as $i => $project): ?>
    
	<table style="width:770px">		
      <tr>		
    <td style="vertical-align:top" width="100%">    
      <h2><?php echo $project->getTitle() ?></h2>
      <?php echo $project->getDescription() ?> <br/>
<br/>
      <?php if($project->hasInfos()) : ?> 
      <h4>Weitere Informationen:</h4>
      <blockquote>
      <?php foreach ($project->getFiles() as $name => $path): ?>   
      <span class="option">—</span><a href="<?php echo '/uploads/project/files/'.$path ?>"><?php echo $name ?></a> <span class="doctype">[PDF]</span><br />
      <?php endforeach ?>      
      <?php foreach ($project->getLinks() as $name => $uri): ?>
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
     </td>
 		<?php
                   $img = $project->getImage();
                   if(!empty($img)) : ?>
		<td style="padding-left:25px;vertical-align:top;text-align:right">
                     <div id="preview">
		   <img src="<?php echo '/uploads/project/images/'.$project->getThumbImage() ?>" title="Für vergrösserte Ansicht bitte klicken" style="cursor:pointer;cursor:hand" border="0"/>
                    </div>
		   </td>
      <?php endif ?>    
      </tr>
      </table>      
      
   
      
<?php if( $i < count($syrinx_projects) - 1 ): ?>
	<div class="separator"></div><br/>
<?php endif ?>
    <?php endforeach ?>

</div>

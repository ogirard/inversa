<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title', 'Akadmie Syrinx') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
<div class="container">
  <div class="header">
    <p><a href="<?php echo url_for('homepage') ?>" onfocus="blur();"><img src="<?php echo image_path('logo_header.png') ?>" class="headerimage" alt="Akademie Syrinx" name="syrinx_logo" width="250" height="59" id="Insert_logo" style="background: #C6D580; display:block;" /></a></p>
    <div class="thickline"></div>
    <div class="tabs">
    <span id="courses" href="<?php echo url_for('content/courses') ?>" class="tab" onclick="OnTabClick(this.id);">Unterrichtsangebot</span>
    <span class="spacer"></span>
    <span id="panflutes" href="<?php echo url_for('content/panflutes') ?>" class="tab" onclick="OnTabClick(this.id);">Panflöten</span>
    <span class="spacer"></span>
    <span id="projects" href="<?php echo url_for('content/projects') ?>" class="tab" onclick="OnTabClick(this.id);">Projekte</span>
    <span class="spacer"></span>
    <span id="calendar" href="<?php echo url_for('content/calendar') ?>" class="tab" onclick="OnTabClick(this.id);">Kalender</span>
    <span class="spacer"></span>
    <span id="aboutus" href="<?php echo url_for('content/aboutus') ?>" class="tab" onclick="OnTabClick(this.id);">Über uns</span>
    <span class="spacer"></span>
    <span id="contact" href="<?php echo url_for('content/contact') ?>" class="tab" onclick="OnTabClick(this.id);">Kontakt</span>
    </div>
    <div class="thinline"></div>
  </div>
  
  <div class="syrinxcontent">
    <?php echo $sf_content ?>
  </div>
  
  <div class="footer">
    <div class="thinline"></div>
    <span class="footertext">Copyright &copy; 2011 by Akademie Syrinx, <a class="info" href="mailto:mail@akademiesyrinx.ch">mail@akademiesyrinx.ch</a></span>
    <span class="footertext" style="float:right"><a class="info" href="/admin.php">Admin</a></span>
  </div>
</div>
  </body>
</html>

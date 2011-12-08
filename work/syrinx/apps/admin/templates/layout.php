<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title', 'Akadmie Syrinx Administration') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
<div class="container">
  <div class="header">
    <p><a href="<?php echo url_for('homepage') ?>" onfocus="blur();"><img src="<?php echo image_path('logo_header_admin.png') ?>" class="headerimage" alt="Akademie Syrinx Administration" name="syrinx_logo" width="403" height="59" id="Insert_logo" style="background: #C6D580; display:block;" /></a></p>
<?php if ($sf_user->isAuthenticated()): ?>    
    <div class="thickline"></div>
    <div class="tabs">
    
    <span id="courses" href="<?php echo url_for('homepage') ?>" class="tab" onclick="OnTabClick(this.id);">Info</span>
    <span class="spacer"></span>
    <span id="panflutes" href="<?php echo url_for('syrinx_calendar') ?>" class="tab" onclick="OnTabClick(this.id);">Kalender</span>
    <span class="spacer"></span>
    <span id="projects" href="<?php echo url_for('syrinx_project') ?>" class="tab" onclick="OnTabClick(this.id);">Projekte</span>
    <span class="spacer"></span>
    <span id="users" href="<?php echo url_for('sf_guard_user') ?>" class="tab" onclick="OnTabClick(this.id);">Benutzer</span>
    </div>
<?php endif ?>
    <div class="thinline"></div>
  </div>
  
  <div class="syrinxcontent">
    <?php echo $sf_content ?>
  </div>
  
  <div class="footer">
    <div class="thinline"></div>
    <span class="footertext">Copyright &copy; 2011 by Akademie Syrinx, <a class="info" href="mailto:mail@akademiesyrinx.ch">mail@akademiesyrinx.ch</a></span>
    
    <span class="footertext" style="float:right"><?php if ($sf_user->isAuthenticated()): ?><a class="info" href="<?php echo url_for('sf_guard_signout') ?>">Logout (<?php echo $sf_user->getUsername() ?>)</a> | <?php endif; ?><a class="info" href="/">Home</a></span>
  </div>
</div>
  </body>
</html>
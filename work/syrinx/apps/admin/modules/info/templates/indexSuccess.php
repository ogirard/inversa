<?php use_helper('Date') ?>
<?php
 function getDateString($dateArray)
 {
   if(count($dateArray) == 0) {
     return 'nie';
   }
   return format_date($dateArray[0]->getUpdatedAt(), "EEEE, dd. MMMM yyyy HH:mm:ss");
 }


 $currentuser = Doctrine::getTable('sfGuardUser')->findOneByUsername($sf_user->getUsername());

 $publishedCalendarCount = count(Doctrine::getTable('SyrinxCalendar')->findByIsPublished(1));
 $calendarCount = count(Doctrine::getTable('SyrinxCalendar')->createQuery()->select('id')->fetchArray());
 
 $calendarLastChanged = getDateString(Doctrine::getTable('SyrinxCalendar')->createQuery()->orderBy('updated_at DESC')->limit(1)->execute());

 $publishedProjectCount = count(Doctrine::getTable('SyrinxProject')->findByIsPublished(1));
 $projectCount = count(Doctrine::getTable('SyrinxProject')->createQuery()->select('id')->fetchArray());
 $projectLastChanged = getDateString(Doctrine::getTable('SyrinxProject')->createQuery()->orderBy('updated_at DESC')->limit(1)->execute());


?>
<h1>Willkommen im Administrationsbereich</h1>
<br />
<h2>Eingeloggt als</h2>
<blockquote>
<table class="info">
<tr>
<td style="vertical-align:top">Benutzername:<br /><br /></td>
<td style="vertical-align:top"><b><?php echo $sf_user->getUsername() ?></b></td>
</tr>
<tr>
<td>
Vorname:
</td>
<td>
<?php echo $currentuser->getFirstName() ?>
</td>
</tr>
<tr>
<td>
Name:
</td>
<td>
<?php echo $currentuser->getLastName() ?>
</td>
</tr>
<tr>
<td>
E-Mail:
</td>
<td>
<?php echo $currentuser->getEmailAddress() ?>
</td>
</tr>
<tr>
<td>
<br/>
<i>Zuletzt eingeloggt:</i>
</td>
<td><br/>
<i><?php echo format_date($currentuser->getLastLogin(), "EEEE, dd. MMMM yyyy HH:mm:ss") ?></i>
</td>
</tr>
</table>
<br/>
Auf der Seite <a href="<?php echo url_for('sf_guard_user') ?>">Benutzer</a> können die Benutzerdaten verwaltet und Benutzer hinzugefügt oder gelöscht werden.<br/>
</blockquote>
<br />
<h2>Kalender</h2>
<blockquote>
<table class="info">
<tr>
<td>
Anzahl Einträge:
</td>
<td>
<b><?php echo $publishedCalendarCount ?></b> publiziert (von Total <?php echo $calendarCount ?>)
</td>
</tr>
<tr>
<td>
<i>Letzte Änderung:</i>
</td>
<td>
<i><?php echo $calendarLastChanged ?></i>
</td>
</tr>
<tr>
<td>Einträge verwalten:
</td><td>
<a href="<?php echo url_for('syrinx_calendar') ?>"/>Kalender</a>
</td>
</tr>
</table>
</blockquote>
<br />
<h2>Projekte</h2>
<blockquote>
<table class="info">
<tr>
<td>
Anzahl Einträge:
</td>
<td>
<b><?php echo $publishedProjectCount ?></b> publiziert (von Total <?php echo $projectCount ?>)
</td>
</tr>
<tr>
<td>
<i>Letzte Änderung:</i>
</td>
<td>
<i><?php echo $projectLastChanged ?></i>
</td>
</tr>
<tr>
<td>Einträge verwalten:
</td><td>
<a href="<?php echo url_for('syrinx_project') ?>"/>Projekte</a>
</td>
</tr>
</table>
</blockquote>
<table width="100%">
<tr>
<td style="text-align:right;">
<span style="color:#AAAAAA; font-size:9pt;">Powered by <a href="http://www.symfony-project.org" target="_blank"><img style="vertical-align:middle; margin-bottom:2px;" src="<?php echo image_path('symfony.gif') ?>" /></a></span>
</td>
</tr>
</table>


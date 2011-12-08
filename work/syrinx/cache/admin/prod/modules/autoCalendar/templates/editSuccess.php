<?php use_helper('I18N', 'Date') ?>
<?php include_partial('calendar/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Kalendereintrag "%%title%%" editieren', array('%%title%%' => $syrinx_calendar->getTitle()), 'messages') ?></h1>

  <?php include_partial('calendar/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('calendar/form_header', array('syrinx_calendar' => $syrinx_calendar, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('calendar/form', array('syrinx_calendar' => $syrinx_calendar, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('calendar/form_footer', array('syrinx_calendar' => $syrinx_calendar, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>

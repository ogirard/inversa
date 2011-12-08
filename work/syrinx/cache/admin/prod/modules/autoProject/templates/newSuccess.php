<?php use_helper('I18N', 'Date') ?>
<?php include_partial('project/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Projekt erstellen', array(), 'messages') ?></h1>

  <?php include_partial('project/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('project/form_header', array('syrinx_project' => $syrinx_project, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('project/form', array('syrinx_project' => $syrinx_project, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('project/form_footer', array('syrinx_project' => $syrinx_project, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>

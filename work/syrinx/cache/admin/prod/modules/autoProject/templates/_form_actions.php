<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'label' => 'Zurück zur Liste',  'params' =>   array(  ),  'class_suffix' => 'list',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Speichern',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
<?php else: ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'label' => 'Projekt löschen',  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',)) ?>
  <?php echo $helper->linkToList(array(  'label' => 'Zurück zur Liste',  'params' =>   array(  ),  'class_suffix' => 'list',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Speichern',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
<?php endif; ?>
</ul>

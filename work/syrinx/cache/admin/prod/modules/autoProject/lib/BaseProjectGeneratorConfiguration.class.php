<?php

/**
 * project module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage project
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProjectGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array(  '_list' =>   array(    'label' => 'Zurück zur Liste',  ),  '_save' =>   array(    'label' => 'Speichern',  ),);
  }

  public function getEditActions()
  {
    return array(  '_delete' =>   array(    'label' => 'Projekt löschen',  ),  '_list' =>   array(    'label' => 'Zurück zur Liste',  ),  '_save' =>   array(    'label' => 'Speichern',  ),);
  }

  public function getListObjectActions()
  {
    return array(  '_edit' =>   array(    'label' => 'Editieren',  ),  '_delete' =>   array(    'label' => 'Löschen',  ),);
  }

  public function getListActions()
  {
    return array(  '_new' =>   array(    'label' => 'Neu',  ),);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '<h2>%%is_published%% %%title%%</h2><br/><table style="border-style:none" cellpadding="0" cellspacing="0" border="0"><tr style="border-style:none"><td width="100%" style="border-style:none"><table style="border-style:none" cellpadding="0" cellspacing="0" border="0"><tbody style="border-style:none; padding: 0px"><tr style="border-style:none; padding: 0px"><td class="name" style="border-style:none; padding: 0px">Beschreibung:</td><td class="value" style="border-style:none">%%description%%</td></tr></tbody></table></td><td style="border-style:none"><img src="/uploads/project/images/thumb_%%image%%" /></td></tr></table>';
  }

  public function getListLayout()
  {
    return 'stacked';
  }

  public function getListTitle()
  {
    return 'Projekte';
  }

  public function getEditTitle()
  {
    return 'Projekt "%%title%%" editieren';
  }

  public function getNewTitle()
  {
    return 'Projekt erstellen';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'title',  1 => 'description',  2 => 'is_published',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'title',  1 => 'description',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'title' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Titel',),
      'description' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Beschreibung',),
      'image' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Bild',),
      'file1' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Datei 1',),
      'file1name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Datei 1',),
      'file2' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Datei 2',),
      'file2name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Datei 2',),
      'file3' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Datei 3',),
      'file3name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Datei 3',),
      'file4' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Datei 4',),
      'file4name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Datei 4',),
      'link1' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Link 1',),
      'link1name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Link 1',),
      'link2' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Link 2',),
      'link2name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Name Link 2',),
      'is_published' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Publiziert?',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'title' => array(),
      'description' => array(),
      'image' => array(),
      'file1' => array(),
      'file1name' => array(),
      'file2' => array(),
      'file2name' => array(),
      'file3' => array(),
      'file3name' => array(),
      'file4' => array(),
      'file4name' => array(),
      'link1' => array(),
      'link1name' => array(),
      'link2' => array(),
      'link2name' => array(),
      'is_published' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'title' => array(),
      'description' => array(),
      'image' => array(),
      'file1' => array(),
      'file1name' => array(),
      'file2' => array(),
      'file2name' => array(),
      'file3' => array(),
      'file3name' => array(),
      'file4' => array(),
      'file4name' => array(),
      'link1' => array(),
      'link1name' => array(),
      'link2' => array(),
      'link2name' => array(),
      'is_published' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'title' => array(),
      'description' => array(),
      'image' => array(),
      'file1' => array(),
      'file1name' => array(),
      'file2' => array(),
      'file2name' => array(),
      'file3' => array(),
      'file3name' => array(),
      'file4' => array(),
      'file4name' => array(),
      'link1' => array(),
      'link1name' => array(),
      'link2' => array(),
      'link2name' => array(),
      'is_published' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'title' => array(),
      'description' => array(),
      'image' => array(),
      'file1' => array(),
      'file1name' => array(),
      'file2' => array(),
      'file2name' => array(),
      'file3' => array(),
      'file3name' => array(),
      'file4' => array(),
      'file4name' => array(),
      'link1' => array(),
      'link1name' => array(),
      'link2' => array(),
      'link2name' => array(),
      'is_published' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'title' => array(),
      'description' => array(),
      'image' => array(),
      'file1' => array(),
      'file1name' => array(),
      'file2' => array(),
      'file2name' => array(),
      'file3' => array(),
      'file3name' => array(),
      'file4' => array(),
      'file4name' => array(),
      'link1' => array(),
      'link1name' => array(),
      'link2' => array(),
      'link2name' => array(),
      'is_published' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'AdminSyrinxProjectForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'SyrinxProjectFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 10;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}

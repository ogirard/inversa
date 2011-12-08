<?php

/**
 * SyrinxCalendar form base class.
 *
 * @method SyrinxCalendar getObject() Returns the current form's model object
 *
 * @package    syrinx
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSyrinxCalendarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
      'time'         => new sfWidgetFormTextarea(),
      'duration'     => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'participants' => new sfWidgetFormTextarea(),
      'venue'        => new sfWidgetFormTextarea(),
      'map'          => new sfWidgetFormTextarea(),
      'image'        => new sfWidgetFormTextarea(),
      'file1'        => new sfWidgetFormTextarea(),
      'file1name'    => new sfWidgetFormTextarea(),
      'file2'        => new sfWidgetFormTextarea(),
      'file2name'    => new sfWidgetFormTextarea(),
      'file3'        => new sfWidgetFormTextarea(),
      'file3name'    => new sfWidgetFormTextarea(),
      'file4'        => new sfWidgetFormTextarea(),
      'file4name'    => new sfWidgetFormTextarea(),
      'link1'        => new sfWidgetFormTextarea(),
      'link1name'    => new sfWidgetFormTextarea(),
      'link2'        => new sfWidgetFormTextarea(),
      'link2name'    => new sfWidgetFormTextarea(),
      'is_published' => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255)),
      'date'         => new sfValidatorDate(),
      'time'         => new sfValidatorString(array('max_length' => 256)),
      'duration'     => new sfValidatorInteger(array('required' => false)),
      'description'  => new sfValidatorString(array('required' => false)),
      'participants' => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'venue'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'map'          => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'image'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file1'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file1name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file2'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file2name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file3'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file3name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file4'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'file4name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'link1'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'link1name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'link2'        => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'link2name'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'is_published' => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('syrinx_calendar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SyrinxCalendar';
  }

}

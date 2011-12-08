<?php

/**
 * SyrinxCalendar filter form base class.
 *
 * @package    syrinx
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSyrinxCalendarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'time'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'duration'     => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'participants' => new sfWidgetFormFilterInput(),
      'venue'        => new sfWidgetFormFilterInput(),
      'map'          => new sfWidgetFormFilterInput(),
      'image'        => new sfWidgetFormFilterInput(),
      'file1'        => new sfWidgetFormFilterInput(),
      'file1name'    => new sfWidgetFormFilterInput(),
      'file2'        => new sfWidgetFormFilterInput(),
      'file2name'    => new sfWidgetFormFilterInput(),
      'file3'        => new sfWidgetFormFilterInput(),
      'file3name'    => new sfWidgetFormFilterInput(),
      'file4'        => new sfWidgetFormFilterInput(),
      'file4name'    => new sfWidgetFormFilterInput(),
      'link1'        => new sfWidgetFormFilterInput(),
      'link1name'    => new sfWidgetFormFilterInput(),
      'link2'        => new sfWidgetFormFilterInput(),
      'link2name'    => new sfWidgetFormFilterInput(),
      'is_published' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'        => new sfValidatorPass(array('required' => false)),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'         => new sfValidatorPass(array('required' => false)),
      'duration'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'  => new sfValidatorPass(array('required' => false)),
      'participants' => new sfValidatorPass(array('required' => false)),
      'venue'        => new sfValidatorPass(array('required' => false)),
      'map'          => new sfValidatorPass(array('required' => false)),
      'image'        => new sfValidatorPass(array('required' => false)),
      'file1'        => new sfValidatorPass(array('required' => false)),
      'file1name'    => new sfValidatorPass(array('required' => false)),
      'file2'        => new sfValidatorPass(array('required' => false)),
      'file2name'    => new sfValidatorPass(array('required' => false)),
      'file3'        => new sfValidatorPass(array('required' => false)),
      'file3name'    => new sfValidatorPass(array('required' => false)),
      'file4'        => new sfValidatorPass(array('required' => false)),
      'file4name'    => new sfValidatorPass(array('required' => false)),
      'link1'        => new sfValidatorPass(array('required' => false)),
      'link1name'    => new sfValidatorPass(array('required' => false)),
      'link2'        => new sfValidatorPass(array('required' => false)),
      'link2name'    => new sfValidatorPass(array('required' => false)),
      'is_published' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('syrinx_calendar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SyrinxCalendar';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'title'        => 'Text',
      'date'         => 'Date',
      'time'         => 'Text',
      'duration'     => 'Number',
      'description'  => 'Text',
      'participants' => 'Text',
      'venue'        => 'Text',
      'map'          => 'Text',
      'image'        => 'Text',
      'file1'        => 'Text',
      'file1name'    => 'Text',
      'file2'        => 'Text',
      'file2name'    => 'Text',
      'file3'        => 'Text',
      'file3name'    => 'Text',
      'file4'        => 'Text',
      'file4name'    => 'Text',
      'link1'        => 'Text',
      'link1name'    => 'Text',
      'link2'        => 'Text',
      'link2name'    => 'Text',
      'is_published' => 'Boolean',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}

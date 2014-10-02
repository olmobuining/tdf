<?php

/**
 * EventmyCharacter filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventmyCharacterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mycharacter_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => true)),
      'event_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
      'approved'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'maybe'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'backup'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'mycharacter_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('myCharacter'), 'column' => 'id')),
      'event_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Event'), 'column' => 'id')),
      'approved'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'maybe'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'backup'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('eventmy_character_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventmyCharacter';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'mycharacter_id' => 'ForeignKey',
      'event_id'       => 'ForeignKey',
      'approved'       => 'Boolean',
      'maybe'          => 'Boolean',
      'backup'         => 'Boolean',
    );
  }
}

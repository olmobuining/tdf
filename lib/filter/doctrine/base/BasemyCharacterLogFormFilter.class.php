<?php

/**
 * myCharacterLog filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemyCharacterLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mycharacter_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => true)),
      'description'    => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'mycharacter_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('myCharacter'), 'column' => 'id')),
      'description'    => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('my_character_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myCharacterLog';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'mycharacter_id' => 'ForeignKey',
      'description'    => 'Text',
      'created_at'     => 'Number',
    );
  }
}

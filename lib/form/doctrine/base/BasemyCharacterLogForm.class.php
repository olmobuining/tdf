<?php

/**
 * myCharacterLog form base class.
 *
 * @method myCharacterLog getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyCharacterLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'mycharacter_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => false)),
      'mycharacter_type_id' => new sfWidgetFormInputText(),
      'description'         => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mycharacter_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'))),
      'mycharacter_type_id' => new sfValidatorInteger(),
      'description'         => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorInteger(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'myCharacterLog', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('my_character_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myCharacterLog';
  }

}

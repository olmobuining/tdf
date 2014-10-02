<?php

/**
 * EventmyCharacter form base class.
 *
 * @method EventmyCharacter getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventmyCharacterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'mycharacter_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => false)),
      'event_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => false)),
      'approved'       => new sfWidgetFormInputCheckbox(),
      'maybe'          => new sfWidgetFormInputCheckbox(),
      'backup'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mycharacter_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'))),
      'event_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Event'))),
      'approved'       => new sfValidatorBoolean(),
      'maybe'          => new sfValidatorBoolean(),
      'backup'         => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'EventmyCharacter', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('eventmy_character[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventmyCharacter';
  }

}

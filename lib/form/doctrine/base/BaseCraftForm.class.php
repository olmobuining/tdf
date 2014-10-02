<?php

/**
 * Craft form base class.
 *
 * @method Craft getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCraftForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'level'           => new sfWidgetFormInputText(),
      'my_character_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => false)),
      'craft_info_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CraftInfo'), 'add_empty' => false)),
      'visible'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'level'           => new sfValidatorInteger(),
      'my_character_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'))),
      'craft_info_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CraftInfo'))),
      'visible'         => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Craft', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('craft[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Craft';
  }

}

<?php

/**
 * Extra form base class.
 *
 * @method Extra getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExtraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'value'          => new sfWidgetFormInputText(),
      'mycharacter_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => true)),
      'extra_type_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ExtraType'), 'add_empty' => false)),
      'user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'image_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'add_empty' => true)),
      'event_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
      'description'    => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormInputText(),
      'updated_at'     => new sfWidgetFormInputText(),
      'public'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'value'          => new sfValidatorInteger(array('required' => false)),
      'mycharacter_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'required' => false)),
      'extra_type_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ExtraType'))),
      'user_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'image_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'required' => false)),
      'event_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorInteger(),
      'updated_at'     => new sfValidatorInteger(array('required' => false)),
      'public'         => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Extra', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('extra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Extra';
  }

}

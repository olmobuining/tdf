<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'username'      => new sfWidgetFormInputText(),
      'password'      => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      'rank_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rank'), 'add_empty' => false)),
      'permission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Permission'), 'add_empty' => false)),
      'first_name'    => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
      'birthdate'     => new sfWidgetFormInputText(),
      'points'        => new sfWidgetFormInputText(),
      'reset_token'   => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'username'      => new sfValidatorString(array('max_length' => 100)),
      'password'      => new sfValidatorString(array('max_length' => 255)),
      'email'         => new sfValidatorEmail(array('max_length' => 255)),
      'rank_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rank'))),
      'permission_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Permission'))),
      'first_name'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'birthdate'     => new sfValidatorInteger(array('required' => false)),
      'points'        => new sfValidatorInteger(array('required' => false)),
      'reset_token'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('username'))),
        new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

}

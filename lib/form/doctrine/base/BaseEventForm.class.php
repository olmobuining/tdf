<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'name'                  => new sfWidgetFormInputText(),
      'description'           => new sfWidgetFormTextarea(),
      'start'                 => new sfWidgetFormInputText(),
      'points'                => new sfWidgetFormInputText(),
      'end'                   => new sfWidgetFormInputText(),
      'pre'                   => new sfWidgetFormInputText(),
      'max_myCharacters'      => new sfWidgetFormInputText(),
      'min_level_requirement' => new sfWidgetFormInputText(),
      'approval_needed'       => new sfWidgetFormInputCheckbox(),
      'guild_event'           => new sfWidgetFormInputCheckbox(),
      'alliance_event'        => new sfWidgetFormInputCheckbox(),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'slug'                  => new sfWidgetFormInputText(),
      'my_characters_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'myCharacter')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 25)),
      'description'           => new sfValidatorString(array('required' => false)),
      'start'                 => new sfValidatorInteger(),
      'points'                => new sfValidatorInteger(array('required' => false)),
      'end'                   => new sfValidatorInteger(),
      'pre'                   => new sfValidatorInteger(),
      'max_myCharacters'      => new sfValidatorInteger(),
      'min_level_requirement' => new sfValidatorInteger(),
      'approval_needed'       => new sfValidatorBoolean(),
      'guild_event'           => new sfValidatorBoolean(),
      'alliance_event'        => new sfValidatorBoolean(),
      'user_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'slug'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'my_characters_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'myCharacter', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Event', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Event', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['my_characters_list']))
    {
      $this->setDefault('my_characters_list', $this->object->myCharacters->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savemyCharactersList($con);

    parent::doSave($con);
  }

  public function savemyCharactersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['my_characters_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->myCharacters->getPrimaryKeys();
    $values = $this->getValue('my_characters_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('myCharacters', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('myCharacters', array_values($link));
    }
  }

}

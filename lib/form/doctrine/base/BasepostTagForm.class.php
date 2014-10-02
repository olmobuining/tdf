<?php

/**
 * PostTag form base class.
 *
 * @method PostTag getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ID'      => new sfWidgetFormInputHidden(),
      'post_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Post'), 'add_empty' => false)),
      'tag_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tag'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'ID'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ID')), 'empty_value' => $this->getObject()->get('ID'), 'required' => false)),
      'post_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Post'))),
      'tag_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tag'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'PostTag', 'column' => array('ID')))
    );

    $this->widgetSchema->setNameFormat('post_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostTag';
  }

}

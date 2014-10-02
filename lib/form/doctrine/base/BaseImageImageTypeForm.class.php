<?php

/**
 * ImageImageType form base class.
 *
 * @method ImageImageType getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImageImageTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ID'            => new sfWidgetFormInputHidden(),
      'image_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'add_empty' => false)),
      'image_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ImageType'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'ID'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ID')), 'empty_value' => $this->getObject()->get('ID'), 'required' => false)),
      'image_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Image'))),
      'image_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ImageType'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ImageImageType', 'column' => array('ID')))
    );

    $this->widgetSchema->setNameFormat('image_image_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageImageType';
  }

}

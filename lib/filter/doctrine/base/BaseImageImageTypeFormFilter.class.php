<?php

/**
 * ImageImageType filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImageImageTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'image_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image'), 'add_empty' => true)),
      'image_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Image_Type'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'image_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Image'), 'column' => 'id')),
      'image_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Image_Type'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('image_image_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageImageType';
  }

  public function getFields()
  {
    return array(
      'ID'            => 'Number',
      'image_id'      => 'ForeignKey',
      'image_type_id' => 'ForeignKey',
    );
  }
}

<?php

/**
 * Image_Type form base class.
 *
 * @method Image_Type getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImage_TypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'images_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Image')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 80)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'images_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Image', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Image_Type', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Image_Type', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('image_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image_Type';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['images_list']))
    {
      $this->setDefault('images_list', $this->object->Images->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveImagesList($con);

    parent::doSave($con);
  }

  public function saveImagesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['images_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Images->getPrimaryKeys();
    $values = $this->getValue('images_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Images', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Images', array_values($link));
    }
  }

}

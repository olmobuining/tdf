<?php

/**
 * Image form base class.
 *
 * @method Image getObject() Returns the current form's model object
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'folder'           => new sfWidgetFormInputText(),
      'src'              => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'text'             => new sfWidgetFormTextarea(),
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'created_at'       => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
      'posts_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Post')),
      'tags_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'image_types_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ImageType')),
      'albums_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Album')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'folder'           => new sfValidatorString(array('max_length' => 150)),
      'src'              => new sfValidatorString(array('max_length' => 150)),
      'title'            => new sfValidatorString(array('max_length' => 80)),
      'text'             => new sfValidatorString(array('required' => false)),
      'user_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'created_at'       => new sfValidatorInteger(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'posts_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Post', 'required' => false)),
      'tags_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'image_types_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ImageType', 'required' => false)),
      'albums_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Album', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Image', 'column' => array('id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Image', 'column' => array('folder'))),
        new sfValidatorDoctrineUnique(array('model' => 'Image', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['posts_list']))
    {
      $this->setDefault('posts_list', $this->object->Posts->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['image_types_list']))
    {
      $this->setDefault('image_types_list', $this->object->ImageTypes->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['albums_list']))
    {
      $this->setDefault('albums_list', $this->object->Albums->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePostsList($con);
    $this->saveTagsList($con);
    $this->saveImageTypesList($con);
    $this->saveAlbumsList($con);

    parent::doSave($con);
  }

  public function savePostsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['posts_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Posts->getPrimaryKeys();
    $values = $this->getValue('posts_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Posts', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Posts', array_values($link));
    }
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tags->getPrimaryKeys();
    $values = $this->getValue('tags_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tags', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tags', array_values($link));
    }
  }

  public function saveImageTypesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['image_types_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ImageTypes->getPrimaryKeys();
    $values = $this->getValue('image_types_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ImageTypes', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ImageTypes', array_values($link));
    }
  }

  public function saveAlbumsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['albums_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Albums->getPrimaryKeys();
    $values = $this->getValue('albums_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Albums', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Albums', array_values($link));
    }
  }

}

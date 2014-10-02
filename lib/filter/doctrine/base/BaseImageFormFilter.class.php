<?php

/**
 * Image filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'folder'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'src'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'             => new sfWidgetFormFilterInput(),
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'             => new sfWidgetFormFilterInput(),
      'posts_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Post')),
      'tags_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tag')),
      'image_types_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Image_Type')),
      'albums_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Album')),
    ));

    $this->setValidators(array(
      'folder'           => new sfValidatorPass(array('required' => false)),
      'src'              => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'text'             => new sfValidatorPass(array('required' => false)),
      'user_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'created_at'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'             => new sfValidatorPass(array('required' => false)),
      'posts_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Post', 'required' => false)),
      'tags_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'image_types_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Image_Type', 'required' => false)),
      'albums_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Album', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPostsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.postImage postImage')
      ->andWhereIn('postImage.post_id', $values)
    ;
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.imageTag imageTag')
      ->andWhereIn('imageTag.tag_id', $values)
    ;
  }

  public function addImageTypesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ImageImageType ImageImageType')
      ->andWhereIn('ImageImageType.image_type_id', $values)
    ;
  }

  public function addAlbumsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ImageAlbum ImageAlbum')
      ->andWhereIn('ImageAlbum.album_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Image';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'folder'           => 'Text',
      'src'              => 'Text',
      'title'            => 'Text',
      'text'             => 'Text',
      'user_id'          => 'ForeignKey',
      'created_at'       => 'Number',
      'slug'             => 'Text',
      'posts_list'       => 'ManyKey',
      'tags_list'        => 'ManyKey',
      'image_types_list' => 'ManyKey',
      'albums_list'      => 'ManyKey',
    );
  }
}

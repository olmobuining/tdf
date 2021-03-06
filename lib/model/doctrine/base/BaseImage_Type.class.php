<?php

/**
 * BaseImage_Type
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Images
 * @property Doctrine_Collection $ImageImageType
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getName()           Returns the current record's "name" value
 * @method Doctrine_Collection getImages()         Returns the current record's "Images" collection
 * @method Doctrine_Collection getImageImageType() Returns the current record's "ImageImageType" collection
 * @method Image_Type          setId()             Sets the current record's "id" value
 * @method Image_Type          setName()           Sets the current record's "name" value
 * @method Image_Type          setImages()         Sets the current record's "Images" collection
 * @method Image_Type          setImageImageType() Sets the current record's "ImageImageType" collection
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseImage_Type extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('image__type');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'unique' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 80, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 80,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Image as Images', array(
             'refClass' => 'ImageImageType',
             'local' => 'image_type_id',
             'foreign' => 'image_id'));

        $this->hasMany('ImageImageType', array(
             'local' => 'id',
             'foreign' => 'image_type_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'options' => NULL,
             'fields' => 
             array(
              0 => 'name',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($sluggable0);
    }
}
<?php

/**
 * BaseImageTag
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID
 * @property integer $image_id
 * @property integer $tag_id
 * @property Image $Image
 * @property Tag $Tag
 * 
 * @method integer  getID()       Returns the current record's "ID" value
 * @method integer  getImageId()  Returns the current record's "image_id" value
 * @method integer  getTagId()    Returns the current record's "tag_id" value
 * @method Image    getImage()    Returns the current record's "Image" value
 * @method Tag      getTag()      Returns the current record's "Tag" value
 * @method ImageTag setID()       Sets the current record's "ID" value
 * @method ImageTag setImageId()  Sets the current record's "image_id" value
 * @method ImageTag setTagId()    Sets the current record's "tag_id" value
 * @method ImageTag setImage()    Sets the current record's "Image" value
 * @method ImageTag setTag()      Sets the current record's "Tag" value
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseImageTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('image_tag');
        $this->hasColumn('ID', 'integer', null, array(
             'primary' => true,
             'unique' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('image_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Image', array(
             'local' => 'image_id',
             'foreign' => 'id'));

        $this->hasOne('Tag', array(
             'local' => 'tag_id',
             'foreign' => 'id'));
    }
}
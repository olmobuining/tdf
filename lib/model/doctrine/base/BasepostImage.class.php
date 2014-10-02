<?php

/**
 * BasePostImage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ID
 * @property integer $image_id
 * @property integer $post_id
 * @property Image $Image
 * @property Post $Post
 * 
 * @method integer   getID()       Returns the current record's "ID" value
 * @method integer   getImageId()  Returns the current record's "image_id" value
 * @method integer   getPostId()   Returns the current record's "post_id" value
 * @method Image     getImage()    Returns the current record's "Image" value
 * @method Post      getPost()     Returns the current record's "Post" value
 * @method PostImage setID()       Sets the current record's "ID" value
 * @method PostImage setImageId()  Sets the current record's "image_id" value
 * @method PostImage setPostId()   Sets the current record's "post_id" value
 * @method PostImage setImage()    Sets the current record's "Image" value
 * @method PostImage setPost()     Sets the current record's "Post" value
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePostImage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('post_image');
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
        $this->hasColumn('post_id', 'integer', null, array(
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

        $this->hasOne('Post', array(
             'local' => 'post_id',
             'foreign' => 'id'));
    }
}
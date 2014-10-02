<?php

/**
 * BasePost
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $post_type_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property User $User
 * @property PostType $PostType
 * @property Doctrine_Collection $Tags
 * @property Doctrine_Collection $Images
 * @property Doctrine_Collection $PostTag
 * @property Doctrine_Collection $PostImage
 * @property Doctrine_Collection $Comments
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getTitle()        Returns the current record's "title" value
 * @method string              getText()         Returns the current record's "text" value
 * @method integer             getPostTypeId()   Returns the current record's "post_type_id" value
 * @method integer             getUserId()       Returns the current record's "user_id" value
 * @method integer             getCreatedAt()    Returns the current record's "created_at" value
 * @method integer             getUpdatedAt()    Returns the current record's "updated_at" value
 * @method User                getUser()         Returns the current record's "User" value
 * @method PostType            getPostType()     Returns the current record's "PostType" value
 * @method Doctrine_Collection getTags()         Returns the current record's "Tags" collection
 * @method Doctrine_Collection getImages()       Returns the current record's "Images" collection
 * @method Doctrine_Collection getPostTag()      Returns the current record's "PostTag" collection
 * @method Doctrine_Collection getPostImage()    Returns the current record's "PostImage" collection
 * @method Doctrine_Collection getComments()     Returns the current record's "Comments" collection
 * @method Post                setId()           Sets the current record's "id" value
 * @method Post                setTitle()        Sets the current record's "title" value
 * @method Post                setText()         Sets the current record's "text" value
 * @method Post                setPostTypeId()   Sets the current record's "post_type_id" value
 * @method Post                setUserId()       Sets the current record's "user_id" value
 * @method Post                setCreatedAt()    Sets the current record's "created_at" value
 * @method Post                setUpdatedAt()    Sets the current record's "updated_at" value
 * @method Post                setUser()         Sets the current record's "User" value
 * @method Post                setPostType()     Sets the current record's "PostType" value
 * @method Post                setTags()         Sets the current record's "Tags" collection
 * @method Post                setImages()       Sets the current record's "Images" collection
 * @method Post                setPostTag()      Sets the current record's "PostTag" collection
 * @method Post                setPostImage()    Sets the current record's "PostImage" collection
 * @method Post                setComments()     Sets the current record's "Comments" collection
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePost extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('post');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'unique' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('title', 'string', 80, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 80,
             ));
        $this->hasColumn('text', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('post_type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('created_at', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('updated_at', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('PostType', array(
             'local' => 'post_type_id',
             'foreign' => 'id'));

        $this->hasMany('Tag as Tags', array(
             'refClass' => 'PostTag',
             'local' => 'post_id',
             'foreign' => 'tag_id'));

        $this->hasMany('Image as Images', array(
             'refClass' => 'PostImage',
             'local' => 'post_id',
             'foreign' => 'image_id'));

        $this->hasMany('PostTag', array(
             'local' => 'id',
             'foreign' => 'post_id'));

        $this->hasMany('PostImage', array(
             'local' => 'id',
             'foreign' => 'post_id'));

        $this->hasMany('Comment as Comments', array(
             'local' => 'id',
             'foreign' => 'post_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'title',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($sluggable0);
    }
}
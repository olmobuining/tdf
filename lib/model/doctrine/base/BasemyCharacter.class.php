<?php

/**
 * BasemyCharacter
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $level
 * @property boolean $main
 * @property integer $user_id
 * @property integer $profession_id
 * @property integer $race_id
 * @property integer $xp_points
 * @property User $User
 * @property Profession $Profession
 * @property Race $Race
 * @property Doctrine_Collection $Events
 * @property Doctrine_Collection $Crafts
 * @property Doctrine_Collection $EventmyCharacters
 * @property Doctrine_Collection $myCharacterLogs
 * @property Doctrine_Collection $Extras
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getName()              Returns the current record's "name" value
 * @method integer             getLevel()             Returns the current record's "level" value
 * @method boolean             getMain()              Returns the current record's "main" value
 * @method integer             getUserId()            Returns the current record's "user_id" value
 * @method integer             getProfessionId()      Returns the current record's "profession_id" value
 * @method integer             getRaceId()            Returns the current record's "race_id" value
 * @method integer             getXpPoints()          Returns the current record's "xp_points" value
 * @method User                getUser()              Returns the current record's "User" value
 * @method Profession          getProfession()        Returns the current record's "Profession" value
 * @method Race                getRace()              Returns the current record's "Race" value
 * @method Doctrine_Collection getEvents()            Returns the current record's "Events" collection
 * @method Doctrine_Collection getCrafts()            Returns the current record's "Crafts" collection
 * @method Doctrine_Collection getEventmyCharacters() Returns the current record's "EventmyCharacters" collection
 * @method Doctrine_Collection getMyCharacterLogs()   Returns the current record's "myCharacterLogs" collection
 * @method Doctrine_Collection getExtras()            Returns the current record's "Extras" collection
 * @method myCharacter         setId()                Sets the current record's "id" value
 * @method myCharacter         setName()              Sets the current record's "name" value
 * @method myCharacter         setLevel()             Sets the current record's "level" value
 * @method myCharacter         setMain()              Sets the current record's "main" value
 * @method myCharacter         setUserId()            Sets the current record's "user_id" value
 * @method myCharacter         setProfessionId()      Sets the current record's "profession_id" value
 * @method myCharacter         setRaceId()            Sets the current record's "race_id" value
 * @method myCharacter         setXpPoints()          Sets the current record's "xp_points" value
 * @method myCharacter         setUser()              Sets the current record's "User" value
 * @method myCharacter         setProfession()        Sets the current record's "Profession" value
 * @method myCharacter         setRace()              Sets the current record's "Race" value
 * @method myCharacter         setEvents()            Sets the current record's "Events" collection
 * @method myCharacter         setCrafts()            Sets the current record's "Crafts" collection
 * @method myCharacter         setEventmyCharacters() Sets the current record's "EventmyCharacters" collection
 * @method myCharacter         setMyCharacterLogs()   Sets the current record's "myCharacterLogs" collection
 * @method myCharacter         setExtras()            Sets the current record's "Extras" collection
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemyCharacter extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_character');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'unique' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 25, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('level', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('main', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('profession_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('race_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('xp_points', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('Profession', array(
             'local' => 'profession_id',
             'foreign' => 'id'));

        $this->hasOne('Race', array(
             'local' => 'race_id',
             'foreign' => 'id'));

        $this->hasMany('Event as Events', array(
             'refClass' => 'EventmyCharacter',
             'local' => 'mycharacter_id',
             'foreign' => 'event_id'));

        $this->hasMany('Craft as Crafts', array(
             'local' => 'id',
             'foreign' => 'my_character_id'));

        $this->hasMany('EventmyCharacter as EventmyCharacters', array(
             'local' => 'id',
             'foreign' => 'mycharacter_id'));

        $this->hasMany('myCharacterLog as myCharacterLogs', array(
             'local' => 'id',
             'foreign' => 'mycharacter_id'));

        $this->hasMany('Extra as Extras', array(
             'local' => 'id',
             'foreign' => 'mycharacter_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'canUpdate' => true,
             ));
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($sluggable0);
        $this->actAs($timestampable0);
    }
}
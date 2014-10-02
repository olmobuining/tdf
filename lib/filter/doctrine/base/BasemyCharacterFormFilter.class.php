<?php

/**
 * myCharacter filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemyCharacterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'level'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'main'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'profession_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profession'), 'add_empty' => true)),
      'race_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Race'), 'add_empty' => true)),
      'xp_points'     => new sfWidgetFormFilterInput(),
      'slug'          => new sfWidgetFormFilterInput(),
      'events_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Event')),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'level'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'main'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'profession_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profession'), 'column' => 'id')),
      'race_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Race'), 'column' => 'id')),
      'xp_points'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'          => new sfValidatorPass(array('required' => false)),
      'events_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Event', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('my_character_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addEventsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.EventmyCharacter EventmyCharacter')
      ->andWhereIn('EventmyCharacter.event_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'myCharacter';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'level'         => 'Number',
      'main'          => 'Boolean',
      'user_id'       => 'ForeignKey',
      'profession_id' => 'ForeignKey',
      'race_id'       => 'ForeignKey',
      'xp_points'     => 'Number',
      'slug'          => 'Text',
      'events_list'   => 'ManyKey',
    );
  }
}

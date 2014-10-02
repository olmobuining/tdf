<?php

/**
 * Event filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'           => new sfWidgetFormFilterInput(),
      'start'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'points'                => new sfWidgetFormFilterInput(),
      'end'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'max_myCharacters'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'min_level_requirement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'approval_needed'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'slug'                  => new sfWidgetFormFilterInput(),
      'my_characters_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'myCharacter')),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'description'           => new sfValidatorPass(array('required' => false)),
      'start'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'points'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'end'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pre'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_myCharacters'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_level_requirement' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approval_needed'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'slug'                  => new sfValidatorPass(array('required' => false)),
      'my_characters_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'myCharacter', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addMyCharactersListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('EventmyCharacter.mycharacter_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'description'           => 'Text',
      'start'                 => 'Number',
      'points'                => 'Number',
      'end'                   => 'Number',
      'pre'                   => 'Number',
      'max_myCharacters'      => 'Number',
      'min_level_requirement' => 'Number',
      'approval_needed'       => 'Boolean',
      'user_id'               => 'ForeignKey',
      'slug'                  => 'Text',
      'my_characters_list'    => 'ManyKey',
    );
  }
}

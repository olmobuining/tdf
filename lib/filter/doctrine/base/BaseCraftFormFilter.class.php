<?php

/**
 * Craft filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCraftFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'level'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'my_character_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCharacter'), 'add_empty' => true)),
      'craft_info_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CraftInfo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'level'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'my_character_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('myCharacter'), 'column' => 'id')),
      'craft_info_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CraftInfo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('craft_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Craft';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'level'           => 'Number',
      'my_character_id' => 'ForeignKey',
      'craft_info_id'   => 'ForeignKey',
    );
  }
}

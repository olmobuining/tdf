<?php

/**
 * User filter form base class.
 *
 * @package    tdf
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rank_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rank'), 'add_empty' => true)),
      'permission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Permission'), 'add_empty' => true)),
      'first_name'    => new sfWidgetFormFilterInput(),
      'last_name'     => new sfWidgetFormFilterInput(),
      'birthdate'     => new sfWidgetFormFilterInput(),
      'points'        => new sfWidgetFormFilterInput(),
      'reset_token'   => new sfWidgetFormFilterInput(),
      'slug'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'      => new sfValidatorPass(array('required' => false)),
      'password'      => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'rank_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rank'), 'column' => 'id')),
      'permission_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Permission'), 'column' => 'id')),
      'first_name'    => new sfValidatorPass(array('required' => false)),
      'last_name'     => new sfValidatorPass(array('required' => false)),
      'birthdate'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'points'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reset_token'   => new sfValidatorPass(array('required' => false)),
      'slug'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'username'      => 'Text',
      'password'      => 'Text',
      'email'         => 'Text',
      'rank_id'       => 'ForeignKey',
      'permission_id' => 'ForeignKey',
      'first_name'    => 'Text',
      'last_name'     => 'Text',
      'birthdate'     => 'Number',
      'points'        => 'Number',
      'reset_token'   => 'Text',
      'slug'          => 'Text',
    );
  }
}

<?php

class applyForm extends BaseForm
{
  public function configure()
  {
	$races = array('Norn', 'Charr', 'Sylvari', 'Asura', 'Human');
	$professions = array('Mesmer', 'Engineer', 'Thief', 'Guardian', 'Necromancer', 'Ranger', 'Warrior', 'Elementalist');
	$preference = array('PvP', 'PvE', 'PvX');
    $this->setWidgets(array(
      'name' => new sfWidgetFormInputText(),
	  'email' => new sfWidgetFormInputText(),
	  'age' => new sfWidgetFormInputText(),
	  'char_name' => new sfWidgetFormInputText(),
	  'char_race' => new sfWidgetFormSelect(array('choices' => $races)),
	  'char_profession'    => new sfWidgetFormSelect(array('choices' => $professions)),
	  'preference' => new sfWidgetFormSelect(array('choices' => $preference)),
	  'extra' => new sfWidgetFormTextarea(array(), array('class' => 'small')),
    ));
	$this->widgetSchema->setLabels(array(
		'name'    => 'Full name',
		'char_profession'    => 'Main Profession',
		'char_name'    => 'Main Character name',
		'char_race'    => 'Main Character race',
		'email'   => 'Email',
		'extra' => 'Anything else we maybe need to know?',
	));
	$this->setValidators(array(
			'name' => new sfValidatorString(array('min_length' => 4), array('min_length' => 'Your name has to be more then 4 characters long.')),
			'char_name' => new sfValidatorString(array('min_length' => 4), array('min_length' => 'Your characters name has to be more then 4 characters long.')),
			'char_profession' => new sfValidatorChoice(array('choices' => array_keys($professions))),
			'char_race' => new sfValidatorChoice(array('choices' => array_keys($races))),
			'preference' => new sfValidatorChoice(array('choices' => array_keys($preference))),
			'age' => new sfValidatorInteger(
						array('min' => 14,'max' => 80), 
						array('min' => 'You must be at least 14 years old')
						),
			'email' => new sfValidatorEmail( 
						array('required' => true),
						array('required' => 'Required.')),
			'extra' => new sfValidatorString(array('required' => false))
    ));
	$this->widgetSchema->setNameFormat("apply[%s]");
  }
}
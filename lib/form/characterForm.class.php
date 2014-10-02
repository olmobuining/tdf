<?php

class characterForm extends BaseForm
{
	public function configure() {
		$races = array(1 => 'Norn', 2 => 'Charr', 3 => 'Sylvari', 4 => 'Asura', 5 => 'Human');
		$main = array( 0 => 'Nee', 1 => 'Ja');
		$professions = array(1 => 'Mesmer',2 => 'Engineer', 3 => 'Thief', 4 => 'Guardian', 5 => 'Necromancer', 6 => 'Ranger', 7 => 'Warrior', 8 => 'Elementalist');
		$crafts = array(0 => '---', 1 => 'Weaponsmith',2 => 'Huntsman', 3 => 'Artificer', 4 => 'Armorsmith', 5 => 'Leatherworker', 6 => 'Tailor', 7 => 'Jeweler', 8 => 'Cook');
		$preference = array('PvP', 'PvE', 'PvX');
		$this->setWidgets(array(
			'name' => new sfWidgetFormInputText(),
			'level' => new sfWidgetFormInputText(),
			'main' => new sfWidgetFormChoice(array('choices' => $main)),
			'race' => new sfWidgetFormSelect(array('choices' => $races)),
			'profession'    => new sfWidgetFormSelect(array('choices' => $professions)),
			'craft1'    => new sfWidgetFormSelect(array('choices' => $crafts)),
			'craft2'    => new sfWidgetFormSelect(array('choices' => $crafts))
		));
		$this->widgetSchema->setLabels(array(
			'profession'    => 'Profession',
			'name'    => 'Naam',
			'race'    => 'Ras',
			'craft1'    => 'Beroep 1',
			'craft2'    => 'Beroep 2',
		));
		$this->setValidators(array(
			'level' => new sfValidatorInteger(array('min' => 1, 'max' => 80), array('min' => 'Min. level is 1', 'max' => 'Max level is 80')),
			'name' => new sfValidatorString(array('min_length' => 4), array('min_length' => 'Je naam is te kort.')),
			'main' => new sfValidatorString(),
			'profession' => new sfValidatorChoice(array('choices' => array_keys($professions))),
			'race' => new sfValidatorChoice(array('choices' => array_keys($races))),
			'craft1'    => new sfValidatorString(array('required' => false)),
			'craft2'    => new sfValidatorString(array('required' => false))
		));
		$this->widgetSchema->setNameFormat("character[%s]");
	}
}
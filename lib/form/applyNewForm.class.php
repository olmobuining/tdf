<?php

class applyNewForm extends BaseForm
{
  public function configure()
  {
	$races = sfConfig::get('app_apply_races');
	$professions = sfConfig::get('app_apply_professions');
	$preference = sfConfig::get('app_apply_preference');
	$gender = sfConfig::get('app_apply_gender');
	$source = sfConfig::get('app_apply_source');
	$countries = sfConfig::get('app_apply_countries');
	$yesno = sfConfig::get('app_apply_yesno');
	$playStyle = sfConfig::get('app_apply_playStyle');
	$labels = sfConfig::get('app_apply_labels');
	
	$level = array();
	for($i=1;$i<81;$i++){
		$level[$i] = $i;
	}
	
	
    $this->setWidgets(array(
      'firstname' => new sfWidgetFormInputText(),
      'surname' => new sfWidgetFormInputText(),
	  'email' => new sfWidgetFormInputText(),
	  'username' => new sfWidgetFormInputText(),
	  'password' => new sfWidgetFormInputPassword(),
	  'password2' => new sfWidgetFormInputPassword(),
	  'date_of_birth' => new sfWidgetFormInputText(),
	  'gender' => new sfWidgetFormSelect(array('choices' => $gender)),
	  'countries' => new sfWidgetFormSelect(array('choices' => $countries)),
	  'ts3' => new sfWidgetFormSelect(array('choices' => $yesno)),
	  'mic' => new sfWidgetFormSelect(array('choices' => $yesno)),
	  'otherguild' => new sfWidgetFormSelect(array('choices' => $yesno)),
	  'guilds' => new sfWidgetFormInputText(),
	  'char_name' => new sfWidgetFormInputText(),
	  'char_race' => new sfWidgetFormSelect(array('choices' => $races)),
	  'char_level' => new sfWidgetFormSelect(array('choices' => $level)),
	  'char_profession'    => new sfWidgetFormSelect(array('choices' => $professions)),
	  'preference' => new sfWidgetFormSelect(array('choices' => $preference)),
	  'motivation' => new sfWidgetFormTextarea(array(), array('class' => 'small')),
	  'playStyle' => new sfWidgetFormSelect(array('choices' => $playStyle)),
	  'source' => new sfWidgetFormSelect(array('choices' => $source)),
	  'source_explanation' => new sfWidgetFormTextarea(array(), array('class' => 'small'))
    ));
	$this->widgetSchema->setLabels($labels);
	$this->setValidators(array(
			'firstname' => new sfValidatorString(array('min_length' => 1, 'required' => true), array('min_length' => 'Je naam moet minimaal 1 tekens lang zijn', 'required' => 'Verplicht')),
			'surname' => new sfValidatorString(array('min_length' => 1, 'required' => true), array('min_length' => 'Je naam moet minimaal 1 tekens lang zijn', 'required' => 'Verplicht')),
			'char_name' => new sfValidatorString(array('min_length' => 4, 'required' => true), array('min_length' => 'Je karakters naam moet minimaal 4 tekens lang zijn', 'required' => 'Verplicht')),
			'date_of_birth' => new sfValidatorString(array('required' => true),	array('required' => 'Verplicht')),
			'username' => new sfValidatorString(array('required' => true),	array('required' => 'Verplicht')),
			'password' => new sfValidatorString(array('min_length' => 4, 'required' => true),	array('min_length' => 'Je wachtwoord moet minimaal 4 tekens lang zijn', 'required' => 'Verplicht')),
			'password2' => new sfValidatorString(array('min_length' => 4, 'required' => true),	array('min_length' => 'Je wachtword moet minimaal 4 tekens lang zijn', 'required' => 'Verplicht')),
			'playStyle' => new sfValidatorChoice(array('choices' => array_keys($playStyle))),
			'gender' => new sfValidatorChoice(array('choices' => array_keys($gender))),
			'countries' => new sfValidatorChoice(array('choices' => array_keys($countries))),
			'ts3' => new sfValidatorChoice(array('choices' => array_keys($yesno))),
			'mic' => new sfValidatorChoice(array('choices' => array_keys($yesno))),
			'otherguild' => new sfValidatorChoice(array('choices' => array_keys($yesno))),
			'char_race' => new sfValidatorChoice(array('choices' => array_keys($races))),
			'char_level' => new sfValidatorChoice(array('choices' => array_keys($level))),
			'preference' => new sfValidatorChoice(array('choices' => array_keys($preference))),
			'char_profession' => new sfValidatorChoice(array('choices' => array_keys($professions))),
			'source' => new sfValidatorChoice(array('choices' => array_keys($source))),
			'email' => new sfValidatorEmail( array('required' => true),	array('required' => 'Verplicht')),
			'motivation' => new sfValidatorString(array('required' => true),	array('required' => 'Verplicht')),
			'source_explanation' => new sfValidatorString(array('required' => false)),
			'guilds' => new sfValidatorString(array('required' => false))
    ));
	$this->widgetSchema->setNameFormat("apply[%s]");
  }
}
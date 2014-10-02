<?php

class searchmyCharactersForm extends BaseForm
{
  public function configure()
  {
	
	$races = sfConfig::get('app_apply_racesEmpty');
	$professions = sfConfig::get('app_apply_professionsEmpty');
	$yesno = array('0' => '---', 'ja' => 'ja', 'nee' => 'nee');
	$level = array();
	for($i=0;$i<80;$i++){
		$level[$i] = $i;
	}
	
	
    $this->setWidgets(array(
	  'races' => new sfWidgetFormSelect(array('choices' => $races)),
	  'professions' => new sfWidgetFormSelect(array('choices' => $professions)),
	  'level' => new sfWidgetFormSelect(array('choices' => $level)),
	  'main' => new sfWidgetFormSelect(array('choices' => $yesno))
    ));
	$this->widgetSchema->setLabels(array('level' => 'Lever hoger dan'));
	$this->setValidators(array(
			'races' => new sfValidatorChoice(array('choices' => array_keys($races))),
			'professions' => new sfValidatorChoice(array('choices' => array_keys($professions))),
			'main' => new sfValidatorChoice(array('choices' => array_keys($yesno))),
			'level' => new sfValidatorChoice(array('choices' => array_keys($level)))
    ));
	$this->widgetSchema->setNameFormat("searchChars[%s]");
  }
}
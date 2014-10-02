<?php

class publicEventForm extends BaseForm {
	
	public function configure() {
		$approval = array(true => 'ja', false => 'nee');
		$hours = array();
		for($i=0;$i<24;$i++)  {
			$hours[$i] = $i; 
		}
		$players = array();
		for($i=1;$i<200;$i++)  {
			$players[$i] = $i; 
		}
		$level = array();
		for($i=1;$i<81;$i++)  {
			$level[$i] = $i; 
		}
		$pre = array();
		$minutes = array();
		for($i=0;$i<61;$i=$i+5)  {
			$minutes[$i] = $i; 
			$pre[($i)] = $i . " minuten" ; 
		}
	//	$end = array(300 => "5 minuten", 900 => "15 minuten", 1800 => "30 minuten", 2700 => "45 minuten", 3600 => "1 uur", 4500 => "1 uur & 15 minuten", 5400 => "1,5 uur", 6300)
		
		
		$this->setWidgets(array(
			'title'    => new sfWidgetFormInputText(),
			'text' => new sfWidgetFormTextarea(),
			'date' => new sfWidgetFormInputText(),
			'hour' => new sfWidgetFormSelect(array('choices' => $hours), array('class' => 'small-select')),
			'minutes' => new sfWidgetFormSelect(array('choices' => $minutes), array('class' => 'small-select')),
			'max_characters' => new sfWidgetFormSelect(array('choices' => $players)),
			'level_requirement' => new sfWidgetFormSelect(array('choices' => $level)),
			'pre' => new sfWidgetFormSelect(array('choices' => $pre)),
			'end' => new sfWidgetFormTime(array(), array('class' => 'small-select')),
			'approval'   => new sfWidgetFormSelect(array('choices' => $approval))
		));
		
		$this->widgetSchema->setLabels(array(
			'title'    => 'Titel',
			'text'    => 'Extra informatie',
			'date'    => 'Datum',
			'hour'    => 'Uur',
			'minutes'    => 'Minuten',
			'max_characters'   => 'Maximaal aantal deelnemers',
			'level_requirement' => 'Level',
			'pre' => 'Verzameltijd',
			'end' => 'Eindtijd',
			'approval' => 'Toestemming',
		));
		
		$this->setValidators(array(
		  'title' => new sfValidatorString( 
						array('required' => true), array('min_length' => 1)),
		  'text' => new sfValidatorString( 
						array('required' => true), array('min_length' => 10)),
		  'date' => new sfValidatorString( 
						array('required' => true)),
		  'hour' => new sfValidatorInteger( 
						array('required' => true), array('max' => 24)),
		  'minutes' => new sfValidatorInteger( 
						array('required' => true), array('max' => 60)),
		  'max_characters' => new sfValidatorInteger( 
						array('required' => true), array('max' => 200)),
		  'level_requirement' => new sfValidatorInteger( 
						array('required' => true), array('max' => 80)),
		  'pre' => new sfValidatorInteger( 
						array('required' => true), array('max' => 1440)),
		  'end' => new sfValidatorTime( 
						array('required' => true)),
		  'approval' => new sfValidatorBoolean( 
						array('required' => true))
		));
		$this->widgetSchema->setNameFormat("public_event[%s]");
	}
}
?>
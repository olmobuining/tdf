<?php

class eventcForm extends BaseForm {
	
	public function configure() {
		$approval = array(true => 'ja', false => 'nee');
		
		$this->setWidgets(array(
			'title'    => new sfWidgetFormInputText(),
			'text' => new sfWidgetFormTextarea(),
			'day' => new sfWidgetFormInputText(),
			'month' => new sfWidgetFormInputText(),
			'year' => new sfWidgetFormInputText(),
			'hour' => new sfWidgetFormInputText(),
			'minutes' => new sfWidgetFormInputText(),
			'max_characters' => new sfWidgetFormInputText(),
			'level_requirement' => new sfWidgetFormInputText(),
			'pre' => new sfWidgetFormInputText(),
			'end' => new sfWidgetFormInputText(),
			'points' => new sfWidgetFormInputText(),
			'approval'   => new sfWidgetFormSelect(array('choices' => $approval))
		));
		$this->setValidators(array(
		  'title' => new sfValidatorString( 
						array('required' => true), array('min_length' => 1)),
		  'text' => new sfValidatorString( 
						array('required' => true), array('min_length' => 10)),
		  'day' => new sfValidatorInteger( 
						array('required' => true), array('max' => 31)),
		  'month' => new sfValidatorInteger( 
						array('required' => true), array('max' => 12)),
		  'year' => new sfValidatorInteger( 
						array('required' => true), array('max' => 2014)),
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
		  'end' => new sfValidatorInteger( 
						array('required' => true), array('max' => 1440)),
		  'points' => new sfValidatorInteger( 
						array('required' => false)),
		  'approval' => new sfValidatorBoolean( 
						array('required' => true))
		));
		$this->widgetSchema->setNameFormat("event[%s]");
	}
}
?>
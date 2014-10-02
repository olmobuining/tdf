<?php

class blogForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'title'    => new sfWidgetFormInputText(),
	  'text' => new sfWidgetFormTextarea()
    ));
	$this->setValidators(array(
      'title' => new sfValidatorString( 
	  				array('required' => true), array('min_length' => 8)),
	  'text' => new sfValidatorString( 
	  				array('required' => true), array('min_length' => 200))
    ));
	$this->widgetSchema->setNameFormat("post[%s]");
  }
}
<?php

class pwResetRequestForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'email'    => new sfWidgetFormInputText()
    ));
	$this->setValidators(array(
	  'email' => new sfValidatorString( 
	  				array('required' => true))
    ));
	$this->widgetSchema->setNameFormat("pwRequest[%s]");
  }
}
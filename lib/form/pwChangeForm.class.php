<?php

class pwChangeForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'token'    => new sfWidgetFormInputText(),
	  'password' => new sfWidgetFormInputPassword(),
	  'rpassword' => new sfWidgetFormInputPassword()
    ));
	$this->widgetSchema->setLabels(array(
		'rpassword'    => 'Herhaal wachtwoord',
		'password'    => 'Wachtwoord'
	));
	$this->setValidators(array(
	  'token' => new sfValidatorString( 
	  				array('required' => true)),
	  'password' => new sfValidatorString( 
	  				array('required' => true)),
	  'rpassword' => new sfValidatorString( 
	  				array('required' => true))
    ));
	$this->widgetSchema->setNameFormat("pwChange[%s]");
  }
}
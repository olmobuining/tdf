<?php

class loginForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'username'    => new sfWidgetFormInputText(),
	  'password' => new sfWidgetFormInputPassword()
    ));
	$this->setValidators(array(
      'username' => new sfValidatorString(),
	  'password' => new sfValidatorString( 
	  				array('required' => true),
 	 				array('required' => 'Please enter a password.'))
    ));
	$this->widgetSchema->setNameFormat("login[%s]");
  }
}
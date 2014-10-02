<?php

class singleInputForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'singleInput'    => new sfWidgetFormInputText()
    ));
	$this->setValidators(array(
      'singleInput' => new sfValidatorString()
    ));
	$this->widgetSchema->setNameFormat("singleInput[%s]");
  }
}
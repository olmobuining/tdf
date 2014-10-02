<?php

class addTagForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'tag'    => new sfWidgetFormInputText()
    ));
	$this->setValidators(array(
      'tag' => new sfValidatorString()
    ));
	$this->widgetSchema->setNameFormat("addTag[%s]");
  }
}
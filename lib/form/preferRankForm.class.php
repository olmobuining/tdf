<?php

class preferRankForm extends BaseForm
{
  public function configure()
  {
  
	$ranks = array(5 => "PvE", 6 => "PvP", 7 => "PvX", 9 => "WvW");
	
    $this->setWidgets(array(
      'rank'    => new sfWidgetFormSelect(array('choices' => $ranks))
    ));
	$this->setValidators(array(
      'rank' 	=> new sfValidatorChoice(array('choices' => array_keys($ranks)))
    ));
	$this->widgetSchema->setNameFormat("preferRank[%s]");
	
  }
}
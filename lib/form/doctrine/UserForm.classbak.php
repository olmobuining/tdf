<?php

/**
 * User form.
 *
 * @package    tdf
 * @subpackage form
 * @author     Olmo Buining
 */
class UserForm extends BaseUserForm
{
	public function configure()
	{
		$this->widgetSchema['permission_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['rank_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['slug'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['birthdate'] = new sfWidgetFormInputText(array(), array('onKeyPress' => 'return disableEnterKey(event)'));
		$this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('onKeyPress' => 'return disableEnterKey(event)'));
		$this->widgetSchema['password_check'] = new sfWidgetFormInputPassword(array(), array('onKeyPress' => 'return disableEnterKey(event)'));
		$this->getWidgetSchema()->moveField('password_check', sfWidgetFormSchema::AFTER, 'password');
		$this->setDefault('permission_id', 1); 
		$this->setDefault('rank_id', 1);
	}
}

<?php

/**
 * editUser form.
 *
 * @package    tdf
 * @subpackage form
 * @author     Olmo Buining
 */
class editUserForm extends BaseUserForm
{
	public function configure() {
		$tranks = Doctrine::getTable('Rank')->getAll();
		$ranks = array();
		foreach ($tranks as $rank)  {
			$ranks[$rank->id] = $rank->name;
		}
		
		$tpermissions = Doctrine::getTable('Permission')->getAll();
		$permissions = array();
		foreach ($tpermissions as $permission)  {
			$permissions[$permission->id] = $permission->name;
		}
		
		$this->setWidgets(array(
			'email' => new sfWidgetFormInput(),
			'rank' => new sfWidgetFormSelect(array('choices' => $ranks)),
			'permission' => new sfWidgetFormSelect(array('choices' => $permissions)),
			'first_name' => new sfWidgetFormInput(),
			'last_name'    => new sfWidgetFormInput()
		));
		
		$this->setValidators(array(
			'email' => new sfValidatorString(),
			'rank' => new sfValidatorChoice(array('choices' => array_keys($ranks))),
			'permission' => new sfValidatorChoice(array('choices' => array_keys($permissions))),
			'first_name' => new sfValidatorString(),
			'last_name' => new sfValidatorString()
		));
		$this->widgetSchema->setNameFormat("editUser[%s]");
	}
}

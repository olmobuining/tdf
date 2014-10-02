<?php

/**
 * Post form.
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PostForm extends BasePostForm
{
  public function configure()
  {
		$this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['tags_list'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['images_list'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['post_type_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['slug'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
		
		/*$this->setValidators(array(
		  'title' => new sfValidatorString( 
						array('required' => true), array('min_length' => 8)),
		  'text' => new sfValidatorString( 
						array('required' => true), array('min_length' => 200))
		));*/
		$this->widgetSchema->setNameFormat("post[%s]");
  }
}

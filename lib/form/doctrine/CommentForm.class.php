<?php

/**
 * Comment form.
 *
 * @package    tdf
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
  public function configure()
  {
		$this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['post_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['text'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
		$this->widgetSchema->setNameFormat('comment[%s]');
		$this->disableLocalCSRFProtection();
  }
}

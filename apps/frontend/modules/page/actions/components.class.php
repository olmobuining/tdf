<?php

/**
 * blog actions.
 *
 * @package    tdf
 * @subpackage blog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeShortBlog(sfWebRequest $request)
	{
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$this->recentBlogs = Doctrine::getTable('Post')->getLastPostsByType(1, 5);
	}
  
  
	public function executeRandomImage(sfWebRequest $request)
	{
		$this->image = Doctrine::getTable('Image')->getRandomImage();
	}
  
  
	public function executeCalendarPreview(sfWebRequest $request)
	{
		$this->events = Doctrine::getTable('Event')->getNextEvents();
	}
  
  
	public function executeLinks(sfWebRequest $request){
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}
	}
  
  
	public function executeMenuExtra(sfWebRequest $request){
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}
	}
	
	
	public function executeCharLog(sfWebRequest $request) {
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged) {
				$this->logs = Doctrine::getTable('myCharacterLog')->getLastLogs(10);
			}
		}
		
	}
}

<?php

/**
 * blog actions.
 *
 * @package    tdf
 * @subpackage blog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeLayoutLogin(sfWebRequest $request)
  {
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		$this->isLoggedIn = $isLoggedIn;
		$this->userLogged = $login->getLoggedUser();
  }
}

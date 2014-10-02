<?php

/**
 * register actions.
 *
 * @package    tdf
 * @subpackage register
 * @author     Olmo Buining
 */
class registerActions extends myActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->getContext()->getConfiguration()->loadHelpers('Url');
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if($isLoggedIn) {
		$userLogged = $login->getLoggedUser();
		if (($userLogged->Permission->level > 99)) {
			 $this->users = Doctrine_Core::getTable('User')
						  ->createQuery('a')
						  ->execute();
		} else {
			$this->redirect(url_for('login'));	
		}
	} else {
		$this->redirect(url_for('login'));		
	}
   
  }
  
  public function executeShow(sfWebRequest $request)
  {
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if($isLoggedIn) {
		$userLogged = $login->getLoggedUser();
		if ($userLogged->Permission->level > 99) {
			$this->user = Doctrine_Core::getTable('User')->find(array($request->getParameter('id')));
			$this->forward404Unless($this->user);
		}
	}
  }
  public function executeNew(sfWebRequest $request)
  {
	// SET META
	$this->getResponse()->addMeta('description', 'Registreer nu op de website van The Dutch Fellowship! U kunt dan reacties plaatsen op een van onze blogs of plaatjes.');
	$this->setTitle(' Registreer nu ');
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if(!$isLoggedIn) {
		$this->form = new userForm();
	} else {
		$this->isLoggedIn = $isLoggedIn; 
	}
  }

  public function executeCreate(sfWebRequest $request)
  {
	
		$this->forward404Unless($request->isMethod(sfRequest::POST));
		$this->form = new userForm();
		$this->processForm($request, $this->form);
		$this->setTemplate('new');
	
  }

  public function executeEdit(sfWebRequest $request)
  {
	$this->forward404Unless($user = Doctrine_Core::getTable('user')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if($isLoggedIn) {
		$userLogged = $login->getLoggedUser();
		if (($userLogged->id == $user->id) OR ($userLogged->Permission->level > 99)) {
			$this->userLogged = $userLogged;
			$user->birthdate = date('d-m-Y', $user->birthdate);
			$this->form = new userForm($user);
		} else {
			$this->redirect('/');	
		}
	} else {
		$this->getContext()->getConfiguration()->loadHelpers('Url');
		$this->redirect(url_for('login'));
	}
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user = Doctrine_Core::getTable('user')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if($isLoggedIn) {
		$userLogged = $login->getLoggedUser();
		if (($userLogged->id == $user->id) OR ($userLogged->Permission->level > 99)) {
			$this->userLogged = $userLogged;
			$this->form = new userForm($user);
		
			$this->processForm($request, $this->form);
		
			$this->setTemplate('edit');
		} else {
			$this->redirect('/');	
		}
	} else {
		$this->getContext()->getConfiguration()->loadHelpers('Url');
		$this->redirect(url_for('login'));
	}
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($user = Doctrine_Core::getTable('user')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $user->delete();

    $this->redirect('register/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
	$pw = new password();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	$parameters = $request->getParameter($form->getName());
	if(!isset($parameters['permission_id'])) {
		$parameters['permission_id'] = 1;
	}
	if(!isset($parameters['rank_id'])) {
		$parameters['rank_id'] = 1;
	}
	unset($parameters['password_check']);
	$parameters['birthdate'] = strtotime($parameters['birthdate']);
	$form->bind($parameters);
	
	//var_dump($parameters);
    if ($form->isValid())
    {
		$parameters['password'] = $pw->makePassword($parameters['password']);
		
		$form->bind($parameters);
		$user = $form->save();
		$to = $parameters['email'];
		try {
		$mailer = $this->getMailer();
		$this->getMailer()->composeAndSend(
			  'info@guild-tdf.nl',
			  $to,
			  'TDF - Registratie website',
"Bedankt voor het registreren op de website van The Dutch Fellowship.
Na dat uw account is geactiveerd kunt u gebruik maken van uw account.

Met vriendelijke groet,

The Dutch Fellowship.
www.guild-tdf.nl"
			);
			
			// Save registration date
			$extra = new Extra();
			$extra->user_id = $user->id;
			$extra->created_at = time();
			$extra->value = 1;
			$extra->description = 'Registratie datum';
			$extraType = Doctrine::getTable('ExtraType')->findOneByCode('REG-DATE');
			$extra->extra_type_id = $extraType->id;
			$extra->public = true;
			$extra->save();
			
			
			$adminlog = new AdminLog();
			$adminlog->created_at = time();
			$adminlog->description = "Registratie gelukt voor ip: ". $_SERVER['REMOTE_ADDR']." | Email naar: ".$to." | Email verstuurd";
			$adminlog->save();
		} catch (Exception $e) {
			$adminlog = new AdminLog();
			$adminlog->created_at = time();
			$adminlog->description = "Mail voor het registreren werkte niet voor:".$user->username." | Error: ".$e->getMessage();
			$adminlog->save();
		}
		$this->getUser()->setAttribute('errorMessage', 'Registratie is gelukt. Een email is verstuurd naar:'. $to);
		$this->getUser()->setAttribute('pushEvent', array('Registreer', 'Nieuw', "$user->username"));
		$this->redirect('/');
    } else {
		$adminlog = new AdminLog();
		$adminlog->created_at = time();
		$adminlog->description = "Registratie mislukt voor ip: ". $_SERVER['REMOTE_ADDR']." | Formulier onvolledig";
		$adminlog->save();
	}
  }
}

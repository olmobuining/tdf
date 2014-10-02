<?php

/**
 * login actions.
 *
 * @package    tdf
 * @subpackage login
 * @author     Olmo Buining
 */
class loginActions extends myActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	  	$login = new LoginClass();
		$isLoggedIn = $login->check();
	  	$this->error = '';
		$this->url = $request->getParameter('url');
		//echo 'Debug Index';
		if(!$isLoggedIn) {
			$this->form = new loginForm();
			if($request->isMethod('post')){
				$this->form->bind($request->getParameter('login'));
				if($this->form->isValid()){
					$password = new password();
					$password = $password->makePassword($this->form->getValue('password'));
					if ($login->loginUsername($this->form->getValue('username'), $password)) {
						$this->error = 'U bent nu ingelogd.';
						if($this->url != "") {
							$this->redirect($request->getParameter('url'));
						} else {
							$this->getContext()->getConfiguration()->loadHelpers('Url');
							$this->redirect(url_for('my_account'));
							$this->disableLogin = true;
						}
					} else {
						$this->error = 'Login is mislukt!';
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = $_SERVER['REMOTE_ADDR']. ' login failed! -> '.$this->form->getValue('username');
						$adminlog->save();
					}
					
				}
			}
		} else {
			$this->getContext()->getConfiguration()->loadHelpers('Url');
			$this->isLoggedIn = $isLoggedIn;
			$this->user = $login->getLoggedUser();
		}
		
  }
  
  
  public function executeLogout(sfWebRequest $request)
  {
	 sfContext::getInstance()->getResponse()->setCookie('login', '', time() - 3600, '/');
	 $this->getContext()->getConfiguration()->loadHelpers('Url');
	 $this->redirect(url_for('login'));
  }
  
  public function executePwResetRequest(sfWebRequest $request)
  {
		
	  	$login = new LoginClass();
		$isLoggedIn = $login->check();
	  	$this->error = '';
		//echo 'Debug Index';
		if(!$isLoggedIn) {
			$this->form = new pwResetRequestForm();
			if($request->isMethod('post')){
				$this->form->bind($request->getParameter('pwRequest'));
				if($this->form->isValid()){
					$user = Doctrine::getTable('User')->findOneByEmail($this->form->getValue('email'));
					if(!$user) {
						$this->getUser()->setAttribute('errorMessage', 'Geen gebruiker gevonden met email:'. $this->form->getValue('email'));
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = $_SERVER['REMOTE_ADDR']. ' verkeerd email:' .$this->form->getValue('email') ;
						$adminlog->save();
					} else {
						$this->getContext()->getConfiguration()->loadHelpers('Url');
						$user->reset_token = md5(rand());
						$user->save();
						try {
						$mailer = $this->getMailer();
						$this->getMailer()->composeAndSend(
							  'info@guild-tdf.nl',
							  $this->form->getValue('email'),
							  'Wachtwoord reset aanvraag',
								"Er is een wachtwoord reset aangevraagd op uw email adres.
								
								Je gebruikers naam: ".$user->username."
								Je token: \"".$user->reset_token."\"
								Om je wachtwoord te resetten ga naar http://www.guild-tdf.nl".url_for('change-pw')." en vul de token in. Daarnaast kan je gelijk een nieuw wachtwoord kiezen door in de volgende vakken precies het zelfde wachtwoord in te voeren.
								
								
								".$_SERVER['REMOTE_ADDR']." Heeft deze aanvraag geplaatst, Als jij dit niet bent geweest. Meld dit dan aan info@guild-tdf.nl met het ip adres wat deze aanvraag heeft aangevraagd. Daarna kun je deze email verwijderen.
								
								Met vriendelijke groet,
								
								The Dutch Fellowship.
								www.guild-tdf.nl"
							);
						} catch (Exception $e) {
							$error = $e->getMessage();
						}
						if ($error != '') {
							$error = 'Het e-mail versturen is mislukt zie hier de error: <br>'.$error;
						} else {
							$error = 'Een email is verstuurd met instructies.';
						}
						$this->getUser()->setAttribute('errorMessage', $error);
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = $_SERVER['REMOTE_ADDR']. ' vroeg password reset aan op email:' .$this->form->getValue('email') ;
						$adminlog->save();
						$this->redirect(url_for('change-pw'));
					}
				}
			}
		} else {
			$this->forward404();
		}
		
  }
  
	public function executePwChange(sfWebRequest $request) {
		$this->form = new pwChangeForm();
		if($request->isMethod('post')){
			$this->form->bind($request->getParameter('pwChange'));
			if($this->form->isValid()){
				$user = Doctrine::getTable('User')->findOneByResetToken($this->form->getValue('token'));
				if(!$user) {
					$this->getUser()->setAttribute('errorMessage', 'Je token klopt niet!');
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $_SERVER['REMOTE_ADDR']. ' token klopt niet! ';
					$adminlog->save();
				} else {
					if ($this->form->getValue('password') == $this->form->getValue('rpassword')) {
						$pw = new password();
						$password = $pw->makePassword($this->form->getValue('password'));
						$user->password = $password;
						$user->reset_token = NULL;
						$user->save();
						$this->getUser()->setAttribute('errorMessage', 'Je wachtwoord is aangepast.');
						$this->getContext()->getConfiguration()->loadHelpers('Url');
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = $_SERVER['REMOTE_ADDR']. ' reset zijn wachtwoord op user:' .$user->username ;
						$adminlog->save();
						$this->redirect(url_for('login'));
					} else {
						$this->getUser()->setAttribute('errorMessage', 'Wachtwoorden komen niet overeen!');
					}
				}
			}
		}
		
	}
}

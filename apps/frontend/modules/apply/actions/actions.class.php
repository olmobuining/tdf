<?php

class applyActions extends myActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	// SET META
	$this->getResponse()->addMeta('description', 'Op zoek naar een Nederlands sprekende guild? Schrijf je dan nu in bij The Dutch Fellowship!');
	$this->setTitle('Inschrijven');
	$races = array('Norn', 'Charr', 'Sylvari', 'Asura', 'Human');
	$professions = array('Mesmer', 'Engineer', 'Thief', 'Guardian', 'Necromancer', 'Ranger', 'Warrior', 'Elementalist');
	$preference = array('PvP', 'PvE', 'PvX');
	$labels = array(
		'name'    => 'Volledige naam',
		'char_profession'    => 'Main Profession',
		'char_name'    => 'Character naam',
		'char_race'    => 'Character ras',
		'email'   => 'Email',
		'extra' => 'Extra info'
  	);
	$this->message = '';
    $this->form = new applyForm();
	if($request->isMethod('post')){
		$this->form->bind($request->getParameter('apply'));
		if($this->form->isValid()){
				$mailer = $this->getMailer();
				$htmlBody = '';
				foreach ($this->form->getValues() as $key => $value) {
					if($key == 'char_profession') {
						$value = $professions[$value];
					} elseif($key == 'char_race') {
						$value = $races[$value];
					} elseif($key == 'preference') {
						$value = $preference[$value];
					} elseif($key == 'email') {
						$to = $value;
					}
					if(array_key_exists($key, $labels)){
						$htmlBody .= $labels[$key]. ': '. $value . "\n";
					} else {
						$htmlBody .= ucfirst($key). ': '. $value . "\n";
					}
						
				}
				$this->getMailer()->composeAndSend(
					  'info@guild-tdf.nl',
					  'info@guild-tdf.nl',
					  'TDF - Aanmelding',
					  $htmlBody
					);
				$mailer = $this->getMailer();
				$this->getMailer()->composeAndSend(
					  'info@guild-tdf.nl',
					  $to,
					  'TDF - Aanmelding',
"Bedankt voor het aanmelden bij The Dutch Fellowship.
Wij nemen uw aanmelding in behandeling en wij zullen contact met u opnemen zodra deze is beoordeeld.

Met vriendelijke groet,

The Dutch Fellowship.
www.guild-tdf.nl"
					);
				$this->message = 'Uw aanmelding is verstuurd!';
				$this->getUser()->setAttribute('pushEvent', array('Apply', 'Nieuw', $to));
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = "Aanmelding:". $htmlBody;
				$adminlog->save();
		} else {
		}
	}
  }
	 public function executeNew(sfWebRequest $request){
		$this->passwordCheck = "";
		// SET META
		$this->getResponse()->addMeta('description', 'Op zoek naar een Nederlands sprekende guild? Schrijf je dan nu in bij The Dutch Fellowship!');
		$this->setTitle('Inschrijven');
		$this->form = new applyNewForm();
		if($request->isMethod('post')){
			$formValues = $request->getParameter('apply');
			$this->form->bind($formValues);
			if($this->form->isValid()){
				if ($formValues['password'] == $formValues['password2']) {
				
					$pw = new password();
					// Make account for user.
					$usera = new User();
					$usera->username = $formValues['username'];
					$usera->password = $pw->makePassword($formValues['password']);
					$usera->rank_id = 1;
					$usera->permission_id = 1;
					$usera->birthdate = strtotime($formValues['date_of_birth']);
					$usera->email = $formValues['email'];
					$usera->first_name = $formValues['firstname'];
					$usera->last_name = $formValues['surname'];
					$usera->points = NULL;
					$usera->reset_token = NULL;
					$usera->save();
					
					// Save registration date
					$extra = new Extra();
					$extra->user_id = $usera->id;
					$extra->created_at = time();
					$extra->value = 1;
					$extra->description = 'Registratie datum';
					$extraType = Doctrine::getTable('ExtraType')->findOneByCode('REG-DATE');
					$extra->extra_type_id = $extraType->id;
					$extra->public = true;
					$extra->save();
					
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Registratie gelukt voor ip: ". $_SERVER['REMOTE_ADDR']." | Email naar: ".$formValues['email']." | Email verstuurd";
					$adminlog->save();
					
					$char_race = sfConfig::get('app_apply_races');
					$char_profession = sfConfig::get('app_apply_professions');
					$preference = sfConfig::get('app_apply_preference');
					$gender = sfConfig::get('app_apply_gender');
					$source = sfConfig::get('app_apply_source');
					$playStyle = sfConfig::get('app_apply_playStyle');
					$labels = sfConfig::get('app_apply_labels');
					$countries = sfConfig::get('app_apply_countries');
					$yesno = sfConfig::get('app_apply_yesno');
					
					$mailer = $this->getMailer();
					$htmlBody = '';
					foreach ($formValues as $key => $value) {
						if ($key == 'password' || $key == 'password2' || $key == '_csrf_token') {
							continue;
						}
						if($key == 'char_profession' || $key == 'char_race' || $key == 'preference' || $key == 'gender' || $key == 'source' || $key == 'playStyle' || $key == 'countries') {
							$theArray = $$key;
							$value = $theArray[$value];
						} elseif($key == 'otherguild' || $key == 'ts3' || $key == 'mic') {
							$value = $yesno[$value];
						} elseif($key == 'email') {
							$to = $value;
						}
						if(array_key_exists($key, $labels)){
							$htmlBody .= $labels[$key]. ': '. $value . "\n";
						} else {
							$htmlBody .= ucfirst($key). ': '. $value . "\n";
						}
					}
					try {
						$this->getMailer()->composeAndSend(
							'info@guild-tdf.nl',
							'info@guild-tdf.nl',
							'TDF - Aanmelding',
							$htmlBody
						);
						$mailer = $this->getMailer();
						$this->getMailer()->composeAndSend(
							  'info@guild-tdf.nl',
							  $to,
							  'TDF - Aanmelding',
								"Bedankt voor het aanmelden bij The Dutch Fellowship.
								Wij nemen je aanmelding in behandeling. Jouw beoordeling zal eerst worden goedgekeurd op ons forum door de officieren. Zodra hier een oordeel van is zullen wij contact op nemen met jou voor de uitslag.
								Een aanmelding kan ongeveer 7 dagen duren.
								
								Met jouw aanmelding heb je gelijk een account aangemaakt op het forum en de website. Het gebruikersnaam voor het forum en de website is: ".$formValues['username']."
								Je kan inloggen met dit account zodra je bent geaccepteerd voor de guild.

								Met vriendelijke groet,

								The Dutch Fellowship.
								www.guild-tdf.nl"
							);
					} catch (Exception $e) {
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = "Mail voor het registreren werkte niet voor:".$usera->username." | Error: ".$e->getMessage();
						$adminlog->save();
					}
					$message = 'Je aanmelding is verstuurd!<br> Wij hebben je als bevestiging een email gestuurd met daarin meer informatie.';
					$this->getUser()->setAttribute('pushEvent', array('Apply', 'Nieuw', $to));
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Aanmelding:". $htmlBody;
					$adminlog->save();
					$this->getUser()->setAttribute('errorMessage', $message);
					sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
					// $this->redirect(url_for('homepage'));
					$this->redirect('/apply/addy?username='.$formValues['username'].'&password='.$formValues['password'].'&email='.$formValues['email']);
				} else {
					$this->passwordCheck = "De wachtwoorden zijn niet gelijk.";
				}
			} else {
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = "Registratie mislukt voor ip: ". $_SERVER['REMOTE_ADDR']." \r\n Formulier onvolledig \r\n Gebruikersnaam: ".$formValues['username']." \r\n Email: ".$formValues['email'];
				$adminlog->save();
			}
		}
	 }
	 public function executeAddy(sfWebRequest $request){
		$this->setLayout(false);
		
		$username = $request->getParameter('username');
		$password = $request->getParameter('password');
		$email = $request->getParameter('email');
		
		$forum = new phpbbForum();
		$userid = $forum->addUser($username,$password,$email);
		var_dump($userid);
		if($userid > 0){
			sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
			$this->redirect(url_for('homepage'));
		} else {
			$adminlog = new AdminLog();
			$adminlog->created_at = time();
			$adminlog->description = "Create of phpbb forum user mislukt";
			$adminlog->save();
			sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
			$this->redirect(url_for('homepage'));
		}
	 }
	 
	
}

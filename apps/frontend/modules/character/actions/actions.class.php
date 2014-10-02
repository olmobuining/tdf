<?php

/**
 * character actions.
 *
 * @package    tdf
 * @subpackage character
 * @author     Olmo Buining
 */
class characterActions extends myActions {
	
	public function executeAdd(sfWebRequest $request) {
		
		$this->setTitle('Karakter toevoegen');
		
		$crafts = array(0 => '---', 1 => 'Weaponsmith',2 => 'Huntsman', 3 => 'Artificer', 4 => 'Armorsmith', 5 => 'Leatherworker', 6 => 'Tailor', 7 => 'Jeweler', 8 => 'Cook');
		
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		
		if($isLoggedIn) {
			$this->characterReq = sfConfig::get('app_permissions_character');
			$this->form = new characterForm();
			$this->userLogged = $login->getLoggedUser();
			if(count($this->userLogged->myCharacters) >= sfConfig::get('app_character_maxcharacters')) {
				$this->redirect('my_account');
			}
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('character'));
				if ($this->form->isValid()) {
					//echo 'valid';
					$char = new myCharacter();
					$char->name = $this->form->getValue('name');
					$char->level = $this->form->getValue('level');
					$char->main = $this->form->getValue('main');
					$char->profession_id = $this->form->getValue('profession');
					$char->race_id = $this->form->getValue('race');
					$char->user_id = $this->userLogged->id;
					$char->save();
					if($this->form->getValue('craft1') != 0) {
						$craft1 = new Craft();
						$craft1->craft_info_id = $this->form->getValue('craft1');
						$craft1->level = 1;
						$craft1->my_character_id = $char->id;
						$craft1->save();
					}
					if($this->form->getValue('craft2') != 0) {
						$craft2 = new Craft();
						$craft2->craft_info_id = $this->form->getValue('craft2');
						$craft2->level = 1;
						$craft2->my_character_id = $char->id;
						$craft2->save();
					}
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = 'nieuw karakter:'. $char->name. '. Door: '. $this->userLogged->username;
					$adminlog->save();
					$charlog = new myCharacterLog();
					$charlog->mycharacter_id = $char->id;
						$charlog->mycharacter_type_id = 1;
					$charlog->description = $char->level;
					$charlog->created_at = time();
					$charlog->save();
					$this->getUser()->setAttribute('pushEvent', array('Karakter', 'Nieuw', "$char->name"));
					$this->getUser()->setAttribute('errorMessage', "Je nieuwe karakter is aangemaakt");
					$this->redirect('my_account');
				} else {
					//echo 'not valid'; 	
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	public function executeRemoveFromEvent(sfWebRequest $request) {
		$eventId = $request->getParameter('eventId');
		$this->message = '';
		//var_dump($eventId);
		if (is_null($eventId)) {
			$this->forward404();
		}
		$event = Doctrine::getTable('Event')->findOneById($eventId);
		$this->forward404unless($event);
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if($event->checkForUser($this->userLogged->id)) {
				$signedChar = $event->getSignedCharacter($this->userLogged->id);
				$link = Doctrine::getTable('EventmyCharacter')->getLink($event->id, $signedChar->id);
				$link->delete();
				$adminLog = new AdminLog();
				$adminLog->description = 'character id: '.$signedChar->id. ' Resigned from event id:'.$event->id;
				$adminLog->created_at = time();
				$adminLog->save();
				
				$this->getUser()->setAttribute('pushEvent', array('Event', 'Resign', "$event->name"));
				$this->getUser()->setAttribute('errorMessage', 'Je bent nu afgemeld van het evenement: '.$event->name);
				
				$this->redirect(url_for('event', array('slug' => $event->slug)));
			} else {
				$this->redirect(url_for('event', array('slug' => $event->slug)));	
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
}

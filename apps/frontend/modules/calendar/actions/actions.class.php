<?php

/**
 * character actions.
 *
 * @package    tdf
 * @subpackage calendar
 * @author     Olmo Buining
 */
class calendarActions extends myActions {
	
	
	protected function setDateValues () {
		$this->daysShort = array(
				1 => 'Maa'
				,2 => 'Din'
				,3 => 'Woe'
				,4 => 'Don'
				,5 => 'Vri'
				,6 => 'Zat'
				,7 => 'Zon'
			);	
	}
	
	
	public function executeGivePoints(sfWebRequest $request) {
		$eventId = $request->getParameter('eventId');
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$this->forward404Unless($userLogged->Permission->level > sfConfig::get('app_event_give_points'));
			$event = Doctrine::getTable('Event')->findOneById($eventId);
			$this->forward404Unless($event);
			if(is_null($event->points)) {
				$this->forward404();
			}
			$approvedCharacters = $event->getApprovedCharacters();
			foreach($approvedCharacters as $character) {
				$character->myCharacter->xp_points = $character->myCharacter->xp_points+$event->points;
				$character->myCharacter->save();
			}
			$errorMessage = "$event->points punt(en) uitgedeeld bij Event: $event->name";
			$adminlog = new AdminLog();
			$adminlog->created_at = time();
			$adminlog->description = $errorMessage;
			$adminlog->save();
			$event->points = NULL;
			$event->save();
			$this->getUser()->setAttribute('errorMessage', $errorMessage);
			sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
			$this->redirect(url_for('event', array('slug' => $event->slug)));
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeNewEvent(sfWebRequest $request) {
		$errorMessage = '';
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$this->forward404Unless($userLogged->Permission->level > sfConfig::get('app_event_new'));
			$this->form = new eventcForm();
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('event'));
				if($this->form->isValid()){
					$event = new Event(); 
					$event->name =  $this->form->getValue('title');
					$event->description =  $this->form->getValue('text');
					$event->start = mktime($this->form->getValue('hour'),$this->form->getValue('minutes'),0,$this->form->getValue('month'),$this->form->getValue('day'),$this->form->getValue('year'));
					$event->pre = $this->form->getValue('pre');
					$event->end = $this->form->getValue('end');
					$event->points = $this->form->getValue('points');
					$event->max_myCharacters = $this->form->getValue('max_characters');
					$event->min_level_requirement = $this->form->getValue('level_requirement');
					$event->approval_needed = $this->form->getValue('approval');
					$event->points = $this->form->getValue('points');
					$event->user_id = $userLogged->id;
					$event->save();
					$errorMessage = 'Event: '.$event->name .' is gemaakt.';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}else {
					$errorMessage = 'Fout bij het maken van een event';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
		$this->getUser()->setAttribute('errorMessage', $errorMessage);
	
	
	}
	
	public function executeNewPublicEvent(sfWebRequest $request) {
		$errorMessage = '';
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$this->forward404Unless($userLogged->Permission->level > sfConfig::get('app_event_public_new'));
			$this->form = new publicEventForm();
			$dateRequest = $request->getParameter('date');
			if (isset($dateRequest)) {
			$this->form->setDefaults(
				array(
					'date' => $dateRequest
					));
			}
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('public_event'));
				if($this->form->isValid()){
					$timeExplode = explode(':', $this->form->getValue('end'));
					$dateExplode = explode('-', $this->form->getValue('date'));
					$event = new Event(); 
					$event->name =  $this->form->getValue('title');
					$event->description =  $this->form->getValue('text');
					$event->start = mktime($this->form->getValue('hour'),$this->form->getValue('minutes'),0,$dateExplode[1],$dateExplode[0],$dateExplode[2]);
					$event->pre = $this->form->getValue('pre');
					$event->end = ($timeExplode[0]*60)+$timeExplode[1];
					$event->max_myCharacters = $this->form->getValue('max_characters');
					$event->min_level_requirement = $this->form->getValue('level_requirement');
					$event->approval_needed = $this->form->getValue('approval');
					$event->points = NULL;
					$event->guild_event = false;
					$event->user_id = $userLogged->id;
					$event->save();
					$errorMessage = 'Event: '.$event->name .' is gemaakt.';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}else {
					$errorMessage = 'Fout bij het maken van een event';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
		$this->getUser()->setAttribute('errorMessage', $errorMessage);
	
	
	}
	
	
	public function executeEditPublicEvent(sfWebRequest $request) {
		$eventId = $request->getParameter('id');
		$errorMessage = '';
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$event = Doctrine::getTable('Event')->findOneById($eventId);
			$this->forward404Unless($event);
			if ($userLogged->Permission->level < sfConfig::get('app_event_edit_all')){
				if($userLogged->Permission->level > sfConfig::get('app_event_public_edit') && $userLogged->id == $event->User->id) {
				} else {
					$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
				}
			} 
			
			$this->form = new publicEventForm();
			if ($event->approval_needed === false) {
				$approvalDefault = 0;
			}elseif($event->approval_needed === true) {
				$approvalDefault = 1;
			}
			$hoursEnd = floor($event->end/60);
			$minutesEnd = floor($event->end-($hoursEnd*60));
			$hoursStart = floor($event->start/60);
			$minutesStart = floor($event->start-($hoursStart*60));
			
			$this->form->setDefaults(
				array(
					'title' => $event->name
					,'text' => $event->description
					,'hour' => date('G', $event->start)
					,'minutes' => date('i', $event->start)
					,'date' => date('j-n-Y', $event->start)
					,'max_characters' => $event->max_myCharacters
					,'approval' => $approvalDefault
					,'level_requirement' => $event->min_level_requirement
					,'end' => $hoursEnd.":".$minutesEnd
					,'pre' => $event->pre
						));
			//$this->form->setValue('text', $event->description);
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('public_event'));
				if($this->form->isValid()){
					$timeExplode = explode(':', $this->form->getValue('end'));
					$dateExplode = explode('-', $this->form->getValue('date'));
					$event->name =  $this->form->getValue('title');
					$event->description =  $this->form->getValue('text');
					$event->start = mktime($this->form->getValue('hour'),$this->form->getValue('minutes'),0,$dateExplode[1],$dateExplode[0],$dateExplode[2]);
					$event->pre = $this->form->getValue('pre');
					$event->end = ($timeExplode[0]*60)+$timeExplode[1];
					$event->max_myCharacters = $this->form->getValue('max_characters');
					$event->min_level_requirement = $this->form->getValue('level_requirement');
					$event->approval_needed = $this->form->getValue('approval');
					$event->points = NULL;
					$event->guild_event = false;
					if ($event->user_id == '') {
						$event->user_id = $userLogged->id;
					}
					$event->save();
					$errorMessage = 'Event: '.$event->name .' is aangepast.';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}else {
					$errorMessage = 'Fout bij het aanpassen van het event';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		$this->event = $event;
		$this->getUser()->setAttribute('errorMessage', $errorMessage);
	
	
	}
	
	public function executeEditEvent(sfWebRequest $request) {
		$eventId = $request->getParameter('id');
		$errorMessage = '';
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$event = Doctrine::getTable('Event')->findOneById($eventId);
			$this->forward404Unless($event);
			if ($userLogged->Permission->level < sfConfig::get('app_event_edit_all')){
				if($userLogged->Permission->level > sfConfig::get('app_event_edit') && $userLogged->id == $event->User->id) {
				} else {
					$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
				}
				
			}
			$this->form = new eventcForm();
			if ($event->approval_needed === false) {
				$approvalDefault = 0;
			}elseif($event->approval_needed === true) {
				$approvalDefault = 1;
			}
			$this->form->setDefaults(
				array(
					'title' => $event->name
					,'text' => $event->description
					,'hour' => date('H', $event->start)
					,'minutes' => date('i', $event->start)
					,'month' => date('n', $event->start)
					,'year' => date('Y', $event->start)
					,'day' => date('j', $event->start)
					,'max_characters' => $event->max_myCharacters
					,'approval' => $approvalDefault
					,'points' => $event->points
					,'level_requirement' => $event->min_level_requirement
					,'end' => $event->end
					,'pre' => $event->pre
						));
			//$this->form->setValue('text', $event->description);
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('event'));
				if($this->form->isValid()){
					$event->name =  $this->form->getValue('title');
					$event->description =  $this->form->getValue('text');
					$event->start = mktime($this->form->getValue('hour'),$this->form->getValue('minutes'),0,$this->form->getValue('month'),$this->form->getValue('day'),$this->form->getValue('year'));
					$event->pre = $this->form->getValue('pre');
					$event->end = $this->form->getValue('end');
					$event->points = $this->form->getValue('points');
					$event->max_myCharacters = $this->form->getValue('max_characters');
					$event->min_level_requirement = $this->form->getValue('level_requirement');
					$event->approval_needed = $this->form->getValue('approval');
					$event->points = $this->form->getValue('points');
					if ($event->user_id == '') {
						$event->user_id = $userLogged->id;
					}
					$event->save();
					$errorMessage = 'Event: '.$event->name .' is aangepast.';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}else {
					$errorMessage = 'Fout bij het aanpassen van het event';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $errorMessage;
					$adminlog->save();
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		$this->event = $event;
		$this->getUser()->setAttribute('errorMessage', $errorMessage);
	
	
	}
	
	public function executeCharStatusChange(sfWebRequest $request) {
		
		$changeTo = $request->getParameter('changeTo');
		$charId= $request->getParameter('charId');
		$eventId = $request->getParameter('eventId');
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$userLogged = $login->getLoggedUser();
			$char = Doctrine::getTable('myCharacter')->findOneById($charId);
			$event = Doctrine::getTable('Event')->findOneById($eventId);
			$this->forward404Unless($userLogged->Permission->level > sfConfig::get('app_event_accept_all') || $userLogged->id == $event->User->id);
			
			$link = Doctrine::getTable('EventmyCharacter')->getLink($eventId, $charId);
			
			$this->forward404Unless($link);
			if( $changeTo == 'accept') {
				$approvedCharacters = $event->getApprovedCharacters();
				if(count($approvedCharacters) == $event->max_myCharacters) {
					$messageToLog = "$event->name heeft het maximum aantal deelnemers al bereikt namelijk: $event->max_myCharacters";
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $messageToLog;
					$adminlog->save();
					$this->getUser()->setAttribute('errorMessage', $messageToLog);
					sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
					$this->redirect(url_for('event', array('slug' => $event->slug)));
				} else {
					$link->approved = true;
					$link->maybe = false;
					$link->backup = false;
					$changeToName = 'geaccepteerd';
				}
			} elseif( $changeTo == 'backup') {
				$link->approved = false;
				$link->maybe = false;
				$link->backup = true;
				$changeToName = 'als backup';
			} elseif( $changeTo == 'maybe') {
				$link->approved = false;
				$link->maybe = true;
				$link->backup = false;
				$changeToName = 'als misschien';
			} elseif( $changeTo == 'remove') {
				$link->approved = false;
				$link->maybe = false;
				$link->backup = false;
				$changeToName = 'verwijderd';
			}
			$link->save();
			$messageToLog = "Character:".$char->name." is ".$changeToName." op event: ".$event->name;
			$adminlog = new AdminLog();
			$adminlog->created_at = time();
			$adminlog->description = $messageToLog;
			$adminlog->save();
			$this->getUser()->setAttribute('errorMessage', $messageToLog);
			sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
			$this->redirect(url_for('event', array('slug' => $event->slug)));
			$this->event = $event;
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeIndex(sfWebRequest $request) {
		$this->setDateValues();
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
		$getMonth = $request->getParameter('month');
		$getYear= $request->getParameter('year');
		$this->today = time();
		if ($getYear != '' && $getYear <= 2014 && $getYear >= 2011) {
			$this->year = $getYear;
		}else {
			$this->year = date('Y', $this->today);
		}
		if ($getMonth != '' && $getMonth <= 12 && $getMonth >= 1) {
			$this->month = date('n', mktime(0,0,0,$getMonth, 1, $this->year));
			$this->firstDay = mktime(0,0,0,$getMonth, 1, $this->year); 
			$this->daysInMonth = cal_days_in_month(0, (int)$getMonth, $this->year); 
		} else { 
			$this->month = date('n', $this->today);
			$this->firstDay = mktime(0,0,0,$this->month, 1, $this->year); 
			$this->daysInMonth = cal_days_in_month(0, $this->month, $this->year); 
		}
		$this->setTitle('Kalender');
		
		
		$day_of_week = date('D', $this->firstDay) ; 
		switch($day_of_week){ 
			 case "Mon": $blank = 0; break; 
			 case "Tue": $blank = 1; break; 
			 case "Wed": $blank = 2; break; 
			 case "Thu": $blank = 3; break; 
			 case "Fri": $blank = 4; break; 
			 case "Sat": $blank = 5; break;
			 case "Sun": $blank = 6; break; 
		}
		$this->blank = $blank;
		$this->countDays = 1;
	}
	
	
	
	public function executeEvent(sfWebRequest $request) {
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$this->setDateValues();
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		$formMessage = '';
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$eventslug = $request->getParameter('slug');
			$this->event = Doctrine::getTable('Event')->findOneBySlug($eventslug);
			$this->forward404unless($this->event);
			if ($request->isMethod('post')) {
				$signingCharId = $request->getParameter('char');
				if(!is_null($signingCharId)) {
					if(!$this->event->checkForUser($this->userLogged->id)) {
						$signedChar = Doctrine::getTable('myCharacter')->findOneById($signingCharId);
						if($signedChar->level >= $this->event->min_level_requirement) {
							$eventCharLink = new EventmyCharacter();
							$eventCharLink->mycharacter_id = $signingCharId;
							$eventCharLink->event_id = $this->event->id;
							//var_dump($this->event->approval_needed );
							if ($this->event->approval_needed == true) {
								$eventCharLink->approved = false;
							} else {
								$eventCharLink->approved = true;
							}
							$eventCharLink->maybe = false;
							$eventCharLink->backup = false;
							$eventCharLink->save();
							$this->getUser()->setAttribute('pushEvent', array('Event', 'Join', "$this->event->name"));
						} else {
							$formMessage = 'Je karakter is voldoet niet aan de level eisen.';
							$adminlog = new AdminLog();
							$adminlog->created_at = time();
							$adminlog->description = $formMessage.' '. $this->signedChar->name.' | event-> '. $this->event->name;
							$adminlog->save();
						}
					} else {
						$formMessage = 'Je hebt al een karakter aangemeld voor dit evenement.';
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = $formMessage.' '. $this->userLogged->username.' | event-> '. $this->event->name;
						$adminlog->save();
					}
				}
			}
			$this->approvedCharacters = $this->event->getApprovedCharacters();
			$this->maybeCharacters = $this->event->getMaybeCharacters();
			$this->backupCharacters = $this->event->getBackupCharacters();
			$this->pendingCharacters = $this->event->getPendingCharacters();
			$this->formMessage = $formMessage;
		}else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
		
	}
}

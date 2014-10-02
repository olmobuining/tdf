<?php


class LoginClass
{
	public function check() {
		$cookie = sfContext::getInstance()->getRequest()->getCookie('login');
		if($cookie)  {
			$value = unserialize(base64_decode($cookie));
			$login = $this->loginId($value['id'], $value['pw']);
			if ($login) {
				return true;
			} else {
				return false;	
			}
		} else {
			return false;	
		}
	}
	public function loginId($id, $password) {
		$user = Doctrine::getTable('User')->findOneById($id);
		if ($user) {
			if ($user->reset_token != NULL ){
				$user->reset_token = NULL;
				$user->save();
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = 'user:'.$user->username. ' wachtwoord reset token naar NULL.';
				$adminlog->save();
			}
			$match = $user->matchPassword($password);
			if ($match) {
				$value = base64_encode(serialize(array('pw' => $user->password, 'id' => $user->id)));
				sfContext::getInstance()->getResponse()->setCookie('login', $value, time()+60*60*24*15, '/');
				$extra = $user->getLastLogin();
				if(!$extra) {
					$extra = new Extra();
					$extra->user_id = $user->id;
					$extra->created_at = time();
					$extra->extra_type_id = 3;
					$extra->public = true;
				}
				$extra->updated_at = time();
				$extra->value = time();
				$extra->save();
				return true;
			} else {
				//echo $id;
				return false;
			}
		} else {
			//echo 'user';
			return false;
		}
	}
	public function loginUsername($username, $password) {
		$user = Doctrine::getTable('User')->findOneByUsername($username);
		if($user) {
			if($this->loginId($user->id, $password)) {
				//echo 'Debug loginUsername: (true), '. $username. ' ' . $password;
				return true;
			} else {
				//echo 'Debug loginUsername(): loginId() fault, '. $username. ' ' . $password;
				return false;	
			}
		} else {
			//echo 'Debug loginUsername(): User fault, '. $username. ' ' . $password;
			return false;	
		}
		
	}
	public function getLoggedUser() {
		$cookie = sfContext::getInstance()->getRequest()->getCookie('login');
		if($cookie)  {
			$value = unserialize(base64_decode($cookie));
			$user = Doctrine::getTable('User')->findOneById($value['id']);
			if ($user) {
				return $user;
			} else {
				//echo 'Debug getLoggedUser: no user';
				return false;	
			}
		} else {
			//echo 'Debug getLoggedUser: no cookie';
			return false;	
		}
	}
}
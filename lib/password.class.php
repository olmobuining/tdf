<?php


class password
{
	public function makePassword ($string) {
		$password = md5($string);
		return $password;
	}
	public function matchPassword ($userInput, $databasePassword) {
		$password = $this->makePassword($userInput);
		if ($databasePassword == $password) { 
			return true;
		} else {
			return false;	
		}
	}
}
<?php

class checkActiveTask extends sfBaseTask
{ 
  protected function configure()
  {
    // // add your own arguments here
    $this->addArgument('user-id', sfCommandArgument::OPTIONAL, 'Enter user ID if you want to check a single user', null);
	$this->addOption('name', null, sfCommandOption::PARAMETER_OPTIONAL, 'Enter username to find', null);

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace				= 'activation';
    $this->name						= 'check';
    $this->briefDescription 		= 'Checks users activation';
    $this->detailedDescription 		= <<<EOF
The [check|INFO] task checks all users activaion
Call it with:

  [php symfony check|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
	
	if($options['name'] != null) {
		$user = Doctrine::getTable('User')->findOneByUsername($options['name']);
		if(!$user) {
			$this->logSection('Error', "User not found!", null, "ERROR");
		} else {
			$registrationDate = $user->getRegistrationDate();
			if($registrationDate->created_at < time()-(60*60*24*30)) {
				if($user->isActive()) {
					$this->logSection('Actief', $user->username);
				} else {
					$this->logSection('Inactief', $user->username);
					$activation = $user->getActivation();
				}
			} else {
				$this->logSection('Stagair', $user->username);
			}
		}
	} elseif($arguments['user-id'] == null) {
		$users = Doctrine::getTable('User')->getAll();
		
		foreach($users as $user) {
			$registrationDate = $user->getRegistrationDate();
			if($registrationDate->created_at < time()-(60*60*24*30)) {
				if($user->isActive()) {
					$this->logSection('Actief', $user->username, null, "COMMAND");
				} else {
					$this->logSection('Inactief', $user->username, null, "INFO");
					$activation = $user->getActivation();
					
				}
			} else {
				$this->logSection('Stagair', $user->username);
				continue;
			}
		}
	}  else {
		$user = Doctrine::getTable('User')->findOneById($arguments['user-id']);
		if(!$user) {
			$this->logSection('Error', "User not found!", null, "ERROR");
		} else {
			$registrationDate = $user->getRegistrationDate();
			if($registrationDate->created_at < time()-(60*60*24*30)) {
				if($user->isActive()) {
					$this->logSection('Actief', $user->username);
				} else {
					$this->logSection('Inactief', $user->username);
					$activation = $user->getActivation();
				}
			} else {
				$this->logSection('Stagair', $user->username);
			}
		}
	
	}
	
	
  }
}

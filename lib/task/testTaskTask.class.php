<?php

class testTaskTask extends sfBaseTask
{ 
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace			= 'olmo';
    $this->name						= 'test';
    $this->briefDescription 		= '';
    $this->detailedDescription 	= <<<EOF
The [test|INFO] task sends a test email to info@guild-tdf.nl
Call it with:

  [php symfony testTask|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
	/*$logins = Doctrine::getTable('User')->getLoginsFromTheLast24Hours();
	$body = "Een Lijst van gebruikers die online zijn geweest sinds gisteren. \n";
	foreach ($logins as $login) {
		$dateFromValue = strftime('%A %e %B %G om %X',$login->value);
		$body .= $login->User->username." : \t\t ".$dateFromValue."\n";
	}
	
	$mailer = $this->getMailer();
	$this->getMailer()->composeAndSend(
					  'info@guild-tdf.nl',
					  'info@guild-tdf.nl',
					  'Gebruikers online',
					  $body
	);*/
	$users = Doctrine::getTable('User')->getAll();
	
	foreach($users as $user) {
		$registrationDate = $user->getRegistrationDate();
		if($registrationDate->created_at < time()-(60*60*24*30)) {
			if($user->isActive()) {
				$this->logSection('Actief', $user->username);
				// echo "Active: ".$user->id ."\n";
			} else {
				// $this->logSection('Inactief', $user->username);
				// echo "Not active: ".$user->id ."\n";
				$activation = $user->getActivation();
				$key = uniqid();
				$activation->description = $key;
				$activation->save();
				if($user->id == 1) {
					if ($activation->updated_at < time()-(60*60*24*30)) {
						$link = "tdf.local/activate-me/".$key."";
						try {
							$context = sfContext::createInstance($this->configuration);
							$this->configuration->loadHelpers('Partial');
							$message  = $this->getMailer()->compose(
										  'info@guild-tdf.nl',
										  'info@guild-tdf.nl',
										  'TDF - Activiteits check'
							);
							$html = "Beste TDF lid,<br><br>

							Dit is een automatische activiteitscontrole.<br>
							Klik de volgende link om je voorkeur te kiezen:<br>
							<div style=\"width:400px;height:20px;background-color:#ccc;padding:5px;\"><a href=\"".$link."\">".$link."</a></div><br><br>
							<br>
							Elke maand wordt er gevraagd wat jouw voorkeur is, zo zit je altijd in de goede voorkeursgroep en hebben wij een accurate lijst van leden die actief zijn. Dit kost slechts 2 &aacute; 3 klikken van je muis, na het openen van je e-mail. <br><br>

							Het is niet verplicht om de activiteitscontrole te doen, wel vragen wij elk lid dat regelmatig online is dit te doen, zodat we een accurate lijst hebben van actieve leden. Hiernaast kun je ook gelijk je voorkeur kiezen. Dus heb je elke maand de mogelijkheid om in een andere voorkeur ingedeeld te worden. <br><br>

							Wanneer je deze activiteitscontrole niet voltooit, zal je naam niet op de Guild Roster getoond worden, ook kan je account (op de website) niet gebruikt worden tot je een voorkeur hebt aangegeven.<br><br>

							Met vriendelijke groet,<br><br>

							The Dutch Fellowship";
							$context->getRequest()->setRequestFormat('html');
							$message->setBody($html, 'text/html');
							$this->getMailer()->send($message);
						} catch (Exception $e) {
							$this->logSection('Error', $e->getMessage());
						}
						$activation->updated_at = time();
						$activation->save();
					}
				}
				
				// $this->logSection('Link', $link);
				
			}
		} else {
			continue;
		}
		// echo $user->id." ".$user->username." ". strftime("%e %B %G", $registrationDate->created_at) ."\n";
	}
	
	
  }
}

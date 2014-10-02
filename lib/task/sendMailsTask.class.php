<?php

class sendMailsTask extends sfBaseTask
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

    $this->namespace				= 'activation';
    $this->name						= 'email-all';
    $this->briefDescription 		= 'Send a activation email to inactive users';
    $this->detailedDescription 	= <<<EOF
The [email-all|INFO] task sends an email to all inactive users. 
Only to users who is inactive and has not had a email within 30 days
This task will run every day at 08:00!

Call it with:

  [php symfony email-all|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
	$users = Doctrine::getTable('User')->getAll();
	$context = sfContext::createInstance($this->configuration);
	
	foreach($users as $user) {
		if($user->rank_id == 1) {
			continue;
		}
		
		$registrationDate = $user->getRegistrationDate();
		
		if($registrationDate->created_at < time()-(60*60*24*30)) {
			if($user->isActive()) {
				$this->logSection('Actief', $user->username);
				// echo "Active: ".$user->id ."\n";
			} else {
			
				$activation = $user->getActivation();
				// if( $user->id == 1 ) {
					// Check when last mail is sent, if is less then 30 days send a mail again.
					if ($activation->updated_at < time()-(60*60*24*30)) {
						
						$activation->updated_at = time();
						$activation->description = md5(time()+$user->id);
						$activation->save();
						$link = "http://guild-tdf.nl/activate-me/".$activation->description."";
						if($user->rank_id == 8 || $user->rank_id == 1) {
							$html = "Beste TDF lid,<br><br>
								
								Gefeliciteerd! Je bent nu bijna volledig lid van de guild, het enige wat je nog hoeft te doen om volledig lid te worden is je voorkeur aan te geven.<br><br>
								
								Klik de volgende link om je voorkeur te kiezen:<br>
								<div style=\"width:400px;height:20px;background-color:#ccc;padding:5px;\"><a href=\"".$link."\">".$link."</a></div><br><br>
								<br>
								Elke maand wordt er gevraagd wat jouw voorkeur is, zo zit je altijd in de goede voorkeursgroep en hebben wij een accurate lijst van leden die actief zijn. Dit kost slechts 2 &aacute; 3 klikken van je muis, na het openen van je e-mail. <br><br>

								Het is niet verplicht om de activiteitscontrole te doen, wel vragen wij elk lid dat regelmatig online is dit te doen, zodat we een accurate lijst hebben van actieve leden. Hiernaast kun je ook gelijk je voorkeur kiezen. Dus heb je elke maand de mogelijkheid om in een andere voorkeur ingedeeld te worden. <br><br>

								Wanneer je deze activiteitscontrole niet voltooit, zal je naam niet op de Guild Roster getoond worden, ook kan je account (op de website) niet gebruikt worden tot je een voorkeur hebt aangegeven.<br><br>

								Met vriendelijke groet,<br><br>

								The Dutch Fellowship";
						} else {
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
						}
						try {
							// $this->configuration->loadHelpers('Partial');
							$message  = $this->getMailer()->compose(
										  'info@guild-tdf.nl',
										  $user->email,
										  'TDF - Activiteits check'
							);
							
							$context->getRequest()->setRequestFormat('html');
							$message->setBody($html, 'text/html');
							$this->getMailer()->send($message);
							$this->logSection('Mail verstuurd', $user->email. " : ".$user->username );
						} catch (Exception $e) {
							$this->logSection('Error', $e->getMessage());
						}
					}
				// }
				
				// $this->logSection('Link', $link);
				
			}
		} else {
			continue;
		}
		// echo $user->id." ".$user->username." ". strftime("%e %B %G", $registrationDate->created_at) ."\n";
	}
	
	
  }
}

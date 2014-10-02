<?php

class testMailSettingsTask extends sfBaseTask
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

    $this->namespace				= 'test';
    $this->name						= 'email';
    $this->briefDescription 		= 'Test the email settings';
    $this->detailedDescription 	= <<<EOF
The task tests the email settings


Call it with:

  [php symfony email|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
	
	$context = sfContext::createInstance($this->configuration);
	
			
	try {
		$html="test email settings.";
	// $this->configuration->loadHelpers('Partial');
		$message  = $this->getMailer()->compose(
					  'info@guild-tdf.nl',
					  "olmobuining@gmail.com",
					  'TDF - check settings'
		);
		
		$context->getRequest()->setRequestFormat('html');
		$message->setBody($html, 'text/html');
		$this->getMailer()->send($message);
		$this->logSection('Mail verstuurd', 'naar olmobuining@gmail.com' );
	} catch (Exception $e) {
		$this->logSection('Error', $e->getMessage());
	}
  }
}

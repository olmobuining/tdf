<pre>
<?php 
require('ts3admin.class.php');
$ts3 = new ts3admin('ts.dutchfellowship.nl', 10011, 10);
$connect = $ts3->connect();
if($connect['success']) {
	$login = $ts3->login('serveradmin', 'oB4XwaCF');
	if($login['success']) {
		$select = $ts3->selectServer(9987);
		if($select['success']) {
			$clientList = $ts3->serverGroupList();
			var_dump($clientList);
			$clientList = $ts3->tokenList();
			var_dump($clientList);
			/*$clientList = $ts3->tokenAdd(0, 9, 0, 'Token for website registerd users');
			print_r($clientList);*/
		} else {
			echo 'Failed to select server. Reason:'.'<br>';
			foreach($select['errors'] as $error){
				echo $error.'<br>';
			}
		}
	} else {
		echo 'Failed to login. Reason:'.'<br>';
		foreach($login['errors'] as $error){
			echo $error.'<br>';
		}
	}
} else {
	echo 'Failed to connect. Reason:'.'<br>';
	foreach($connect['errors'] as $error){
		echo $error.'<br>';
	}
}
?>
</pre>
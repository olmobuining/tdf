<pre>
<?php 
require('ts3admin.class.php');
$ts3 = new ts3admin('ts.dutchfellowship.nl', 10011);
$connect = $ts3->connect();
if($connect['success']) {
	$login = $ts3->login('serveradmin', 'oB4XwaCF');
	if($login['success']) {
		$select = $ts3->selectServer(9987);
		if($select['success']) {
			/*$clientList = $ts3->hostInfo();
			var_dump($clientList);
			$clientList = $ts3->tokenAdd(0, 10, 0, 'Token for website registerd users');
			print_r($clientList['data']['token']);*/
			
			$c = $ts3->tokenList();
			print_r($c);
			/*foreach($c['data'] as $b) {
				$ts3->tokenDelete($b['token']);
			}
			print_r($c);*/
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
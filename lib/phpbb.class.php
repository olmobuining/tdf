<?php 
class phpbbForum {
	
	
	public function addUser($username ,$password, $email) {
		define('IN_PHPBB', true);
		global $phpbb_root_path;
		global $phpEx;
		global $db;
		global $config;
		global $user;
		global $auth;
		global $cache;
		global $template;
		
		$phpEx = substr(strrchr(__FILE__, '.'), 1);
		// $phpbb_root_path = '/var/www/forum/';
		$phpbb_root_path = '/var/www/forum/';


		/* includes all the libraries etc. required */
		require($phpbb_root_path ."common.php");

		$user->session_begin();
		$auth->acl($user->data);

		/* the file with the actual goodies */
		require($phpbb_root_path ."includes/functions_user.php");

		/* All the user data (I think you can set other database fields aswell, these seem to be required )*/
		$user_row = array(
		'username' => $username,
		'user_password' => md5($password), 
		'user_email' => $email,
		'group_id' => 7,
		'user_timezone' => '0.00',
		'user_dst' => 0,
		'user_lang' => 'en',
		'user_type' => '0',
		'user_actkey' => '',
		'user_dateformat' => 'd M Y H:i',
		'user_style' => 1,
		'user_regdate' => time(),
		);

		/* Now Register user */
		$phpbb_user_id = user_add($user_row);
		$user = NULL;
		return $phpbb_user_id;
	}
}

?>
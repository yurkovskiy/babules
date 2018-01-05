<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'dbauth',
	'hash_method'  => 'md5',
	'hash_key'     => 'abracadabra',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	
);

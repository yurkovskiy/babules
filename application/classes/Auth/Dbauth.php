<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Dbauth - database (simple) driver for Kohana Auth Module
 * @author Yuriy Bezgachnyuk
 * @copyright 2013 by Yuriy Bezgachnyuk, IF, Ukraine
 *
 */

class Auth_Dbauth extends Auth 
{
	
	/**
	 * System Login method
	 *
	 * @param String $username
	 * @param String $password
	 * @param String $remember
	 * @return boolean
	 */
	protected function _login($username, $password, $remember) 
	{

		if (is_string($password)) 
		{
			// Create a hashed password
			$password = $this->hash($password);
		}

		// get user_id from database
		$user_id = Model::factory("Users")->check_user($username, $password);
		if ($user_id > 0) 
		{
			$userLogged = Model::factory("Users")->logged($user_id, 1);
			if ($userLogged) 
			{
				return $this->complete_login($username);
			}
		}

		return false;
	}

	/**
	 * Enter description here...
	 *
	 * @param boolean $destroy
	 * @param boolean $logout_all
	 */
	public function logout($destroy = FALSE, $logout_all = FALSE) 
	{
		$user_id = Model::factory("Users")->getUserIdByLogin($this->get_user());
		$userLogged = Model::factory("Users")->logged($user_id, 0);
		parent::logout(true, true);
	}

	public function password($username) 
	{
		return null;
	}

	public function check_password($password) 
	{
		return false;
	}
}
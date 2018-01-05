<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions users table model
 *
 */

class Model_Users extends Model_Common {

	protected $tableName = "users";
	protected $fieldNames = array("user_id", "user_login", "user_password", "user_surname", "user_name", "user_fname", "user_lastaccess", "user_logged");

	/**
	 * check user by login and password
	 *
	 * @param unknown_type $user_login
	 * @param unknown_type $user_password
	 * @return unknown
	 */
	public function check_user($user_login, $user_password) {
		$query = DB::select_array($this->fieldNames)->from($this->tableName)
		->where($this->fieldNames[1], "=", $user_login)
		->and_where($this->fieldNames[2], "=", $user_password)
		->limit(1);
		$result = $query->as_object()->execute();
		foreach ($result as $user) {
			if (!is_null($user->user_id)) {
				return $user->user_id;
			}
		}
	}

	/**
	 * Method which return user_id by user_login
	 *
	 * @param String $user_login
	 * @return int user_id
	 */
	public function getUserIdByLogin($user_login) {
		$query = DB::select_array($this->fieldNames)->from($this->tableName)
		->where($this->fieldNames[1], "=", $user_login)
		->limit(1);
		$result = $query->as_object()->execute();
		foreach ($result as $user) {
			if (!is_null($user->user_id)) {
				return $user->user_id;
			}
		}
	}


	/**
	 * Method for update user logged status in database
	 *
	 * @param int $user_id
	 * @param int $value - 0 - not logged, 1 - logged
	 * @return boolean
	 */
	public function logged($user_id, $value) {
		$rows = null;
		$query = DB::update($this->tableName)
		->value($this->fieldNames[7], $value)
		->where($this->fieldNames[0], "=", $user_id);
		try {
			$rows = $query->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "Code: ".$error->getCode()."<br>".$error->getMessage();
			return $this->errorMessage;
		}
		if ($rows >= 0 ) return true;
	}
}
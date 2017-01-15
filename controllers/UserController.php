<?php
namespace Controllers;

use \Controllers\JmController;
use \Tamtamchik\SimpleFlash\Flash;
use \Helpers\Config;
// @todo add user_id to submissions table
class UserController extends JmController
{
	public function register($request)
	{
		var_dump('register method -- coming soon homies'); die;
		
		$username = $request['email'];
		$password = $request['password']; 
		$password = password_hash($password, PASSWORD_DEFAULT);

		$data = compact('username', 'password');
		$register = $this->db->insert($this->table, $data);
		if ($register) {
			var_dump('we did it'); die; 
		}
	}

	public function login($request)
	{
		$username = $request['email'];
		$password = 'getpassfromdb'; // query pass from db
		if (password_verify($request['password'], $password)) {
			// set session id as something
		}
	}
}
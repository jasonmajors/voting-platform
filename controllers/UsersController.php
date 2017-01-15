<?php
namespace Controllers;

use \Controllers\JmController;
use \Tamtamchik\SimpleFlash\Flash;
use \Controllers\SubmissionController;

// @todo add user_id to submissions table
class UsersController extends JmController
{
	public function register($request)
	{
		if (!filter_var($request['council-email'], FILTER_VALIDATE_EMAIL)) {
			var_dump("don't be clever"); die;
		}

		if (!$request['council-password']) {
			var_dump("invalid password"); die;
		}

		$subs = new SubmissionController();
		list($approved, $submitted) = $subs->getSubmissions();

		$email    = $request['council-email'];
		$password = $request['council-password']; 	
		$password = password_hash($password, PASSWORD_BCRYPT);

		$data = compact('email', 'password');
		// Register the user.. Should this be an Auth class static method?
		try {
			$register = $this->db->insert($this->table, $data);
		// Check for email address already existing
		} catch (\PDOException $exception) {
			$error = $exception->getMessage();
		}
		// No issues? Register them
		if ($register && empty($error)) {
			$alert = "Let's do this then.";

			return [ROOT_PATH . '/views/test.view.php', $alert, $approved, $submitted];
		} 
		// Uh oh somethings amiss
		elseif ($error) {
			// Handle unique error
			if (strpos(strtolower($error), 'duplicate entry') !== false) {
				$error = "We already have a user with the email $email.";
			} 

			$alert = "Uh oh! Something went wrong:" . "<br>" . $error;

			return [ROOT_PATH . '/views/test.view.php', $alert, $approved, $submitted];
		}
	}

	public function login($request)
	{
		// post vars
		$email    = $request['council-email'];
		$password = $request['council-password']; 
		
		if (password_verify($request['council-password'], $password)) {
			// set session id as something
		}
	}
}
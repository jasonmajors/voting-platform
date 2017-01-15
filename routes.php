<?php
namespace Jm;

use \Controllers\SubmissionController;
use \Controllers\VotesController;
use \Controllers\UsersController;
use \Helpers\Config;
use \Helpers\Router;


/*$router = new Router();
$router->setRoute("", 'SubmissionController', 'get', 'index');
$router->run();*/

$fullUri = $_SERVER['REQUEST_URI'];
// if we host at mysite.com/[base]
$base = "";
$uri = str_replace($base, '', $fullUri);

$querystring = strpos($uri, '?');
// Remove any query strings off the end of the uri for parsing
if ($querystring !== false) {
	$uri = strstr($uri, '?', true); 
}



/**
* @todo This isn't really going to be scalable
*/
switch($uri) {
	case (""):
		$submissionController = new SubmissionController();
		// Handle post request @ index
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			list($view, $alert, $approved, $submitted) = $submissionController->storeSubmission($_POST);
		// Currently anything else but post
		} else {
			list($view, $approved, $submitted) = $submissionController->index();
		}
		// Load the view
		require_once $view;
		break;

	case ("vote"):
		$votesController = new VotesController();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			// call the VotesController method to add a vote and check if its last vote needed
			list($view) = $votesController->submitVote($_GET);
		}

		require_once $view;
		break;

	case("register"):
		$usersController = new UsersController();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// try to register the homie
			list($view, $alert, $approved, $submitted) = $usersController->register($_POST);
			require_once $view;
		}
		var_dump('what are you doing?!'); die;

	case("login"):
		$usersController = new UsersController();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//
		}

		require_once $view;
		break;

	default:
		// @todo make a 404 page
		echo "404"; die;
		break;	
}

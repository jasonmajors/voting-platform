<?php
namespace Controllers;

use \Controllers\JmController;
use \Helpers\VotingHandler;
use \Helpers\Config;

class SubmissionController extends JmController
{
	public function index()
	{
		list($approved, $submitted) = $this->getSubmissions();

		//$vars = compact('approved', 'submitted');
		return [ROOT_PATH . '/views/test.view.php', $approved, $submitted];
	}

	public function getSubmissions()
	{
		$entries  = $this->db->select($this->table, ['status' => 1]);
		$approved   = [];

		foreach ($entries as $submission) {
			$submission_id = $submission['id'];
			$content 	   = $submission['content'];

			$table    = "votes";
			$data     = $this->db->query($table, "SELECT SUM(vote), COUNT(*) FROM $table WHERE submission_id = ?", [$submission_id])->fetch();
			$yesVotes = (int) $data['SUM(vote)'];
    		$voters   = (int) $data['COUNT(*)'];
    		$success  = $this->everyoneImage();
    		// If approved by 100%, set percentage to ALL OF EM, else set to the percentage string
    		$percentage = ($yesVotes / $voters == 1) ? '100%' : number_format(($yesVotes / $voters * 100), 2, ".", ",") . '%';

 			$approved[] = compact('content', 'percentage');
		}

		$submitted = ['temp']; // Probably don't need submitted anymore

		return [$approved, $submitted];
	}


	private function everyoneImage()
	{
		$imgUrl = SITE_URL . '/assets/images/success.jpg';
		$html = "<img class='council-icon' src=$imgUrl ><img class='council-icon' src=$imgUrl ><img class='council-icon' src=$imgUrl >";

		return $html;
	}

	/**
	* Stores a RWP submission entry if unique
	*
	* @param array $request The http post request
	* @return void
	*/
	public function storeSubmission(array $request)
	{
		if (empty($request['content'])) {
			// @todo Data validation
			exit('No entry??');
		}
		// Remove html tags since we'll be emailing this content
		$content = trim(strip_tags($request['content']));
		$soundEx = soundex($content); // Creates a key based off prunciation, db forces this to be unique. works like magic

		$data    = compact('content', 'soundEx');
		
		try {
			$insert = $this->db->insert($this->table, $data);
		} 
		catch (\PDOException $exception) {
			$error = $exception->getMessage();
		}

		if ($insert) {
			// @todo Need to tweak this. Technically it's fine since content column is unique, but if content is not unique this will just return the first match
			$submission_id = $this->db->select($this->table, $data)[0]['id'];
			VotingHandler::sendEmails(Config::$EMAILS, $submission_id, $content);
			$alert = "Thank you for your submission";
		} else {
			// Handle unique error
			if (strpos(strtolower($error), 'duplicate entry') !== false) {
				$error = "Looks like '$content' or something similar has already been submitted";
			}

			$alert = "Uh oh! Something went wrong:" . "<br>" . $error;
		}
		
		list($approved, $submitted) = $this->getSubmissions();

		return [ROOT_PATH . '/views/test.view.php', $alert, $approved, $submitted];
	}


	/**
	* Updates the status from 0 to 1 for a submission, making it the submission viewable
	*
	* @param int $submission_id
	* @return bool
	*/
	public function publish($submission_id)
	{
		return $this->db->update($this->table, ['status' => 1], ['id' => $submission_id]);
	}


	// View details on a single submissions. will be a GET request on /submission
	public function getSubmission($submission_id)
	{
		// admin only
	}

	// Delete a submission. will be a DELETE request on /submission
	public function deleteSubmission($submission_id)
	{
		// admin only
	}

}
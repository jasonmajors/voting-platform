<?php
namespace Controllers;

use \Controllers\JmController;
use \Helpers\Config;
use \Controllers\SubmissionController;

class VotesController extends JmController
{
	private function updateVotes($submission_id)
	{
		// Returns an array containing the sum of this submission's total votes and yes-votes
    	$votes = $this->db->query($this->table,
    		"SELECT SUM(vote), COUNT(*) FROM $this->table WHERE submission_id = ?",
    		[$submission_id]
    		)
    		->fetch();

    	$yesVotes 	= (int) $votes['SUM(vote)'];
    	$voters 	= (int) $votes['COUNT(*)'];
    	// Everyones voted and the majority vote is yes
    	if ($yesVotes > (0.5 * $voters)) {
    		$subs = new SubmissionController();
    		$subs->publish($submission_id);
    	}
	}


	public function submitVote(array $request)
	{
	   	$secret        = $request['sec'];
	    $vote      	   = $request['vote'];
	    $submission_id = $request['id'];
	    // Check if this member hasn't voted yet
	    $status = 0;
	    $conditions = compact('secret', 'status', 'submission_id');
	    $openVote = $this->db->select($this->table, $conditions);

	    if (!empty($openVote)) {
    		// Cast vote
	    	$status  = 1;
	    	$updates = compact('status', 'vote');

	    	$this->db->update($this->table, $updates, $conditions);
	    	$this->updateVotes($submission_id);
	    	
	    	if ($vote == 1) {
    			return [ROOT_PATH . '/views/yes-vote.view.php'];
	    	}

	    	if ($vote == 0) {
	    		return [ROOT_PATH . '/views/no-vote.view.php'];
	    	}

	    } else {
			var_dump('Can only vote once!'); die;
	    }
	}
}
<?php

namespace Helpers;

use \Jaywrap\Jaywrap;

class VotingHandler
{
	const VOTES_TABLE = 'votes';

	public static function sendEmails(array $emailAddresses, $submission_id, $content)
	{	
		$db = new Jaywrap();
		foreach ($emailAddresses as $email) {
			// Set unique keys for each vote in the db
			$secret  = md5(rand(0, 1000));
			$data = compact('secret', 'submission_id');
			$db->insert(self::VOTES_TABLE, $data);
			// Prepare email, 1 yes, 0 no
			$yesVoteUrl = SITE_URL . "/vote?vote=1&id=$submission_id&sec=$secret";
			$noVoteUrl  = SITE_URL . "/vote?vote=0&id=$submission_id&sec=$secret";

			$headers 	= "From: 'OC People' <oc@jasonmajors.net>\r\n";
			$headers   .= "MIME-Version: 1.0\r\n";
			$headers   .= "Content-Type: text/html; charset=UTF-8\r\n";

			$body = file_get_contents(ROOT_PATH . '/views/emails/vote.html');
			$body = str_replace('{{ SUBMISSION }}', $content, $body);
			$body = str_replace('{{ YES_URL }}', $yesVoteUrl, $body);
			$body = str_replace('{{ NO_URL }}', $noVoteUrl, $body);
			// Send
			mail($email, 'New Submission', $body, $headers);
		}
	}
}
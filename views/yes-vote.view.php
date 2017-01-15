<?php 
if (!defined('SITE_URL')) {
	define('SITE_URL', 'http://www.jasonmajors.net/rwp');
} 
?>
<html>
	<head>
		<title>OC People Stuff</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href=<?php echo SITE_URL . "/assets/css/style.css"; ?>>
	</head>
	<body class="yes-vote-body">
		<div class="vote-container">
			<div class="xy-align-center">
				<span class="big-heading"><?php echo \Helpers\Config::getYesPhrase(); ?></span>
				<p><a class="vote-page-link" href=<?php echo SITE_URL; ?>>View the rest</a></p>
			</div>
		</div>
	</body>
</html>
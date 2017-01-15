<html>
<head>
	<title>OC People Stuff</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body class="main">
<div class="container">
	<h1 class="text-center">Orange County Stuff</h1>
	<?php if (isset($output)):  ?>
		<?=$output; ?>
	<?php endif; ?>
		<ul>
		<?php 
			foreach ($approved as $item):
				$html  = $item['content'];
				$html .= ' - submitted: ' . $item['submitted'];
			?>
			<li><?php echo $html; ?></li>
		<?php endforeach; ?>
		</ul>
	<h2>Submit</h2>
	<form action="" method='post'>
		<label for="content">New Entry</label>
		<input type="text" name="content">
		<button type="submit">Submit</button>
	</form>
</div>
</body>
</html>
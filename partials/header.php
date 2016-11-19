<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $pageTitle; ?></title>

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="../assets/style.css">
	</head>
	<body>

		<?php if (isset($flash_message)) { ?>
			<div class="flashMessage"><h4><?php echo $flash_message; ?></div>
		<?php } ?>

		<?php if (isset($flash_error)) { ?>
			<div class="flashError"><h4><?php echo $flash_error; ?></div>
		<?php } ?>

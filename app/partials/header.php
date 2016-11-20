<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $this->pageTitle; ?></title>

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="../assets/style.css">
	</head>
	<body>

		<?php if (isset($this->flash_message)) { ?>
			<div class="flashMessage"><h4><?php echo $this->flash_message; ?></div>
		<?php } ?>

		<?php if (isset($this->flash_error)) { ?>
			<div class="flashError"><h4><?php echo $this->flash_error; ?></div>
		<?php } ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $this->pageTitle; ?></title>
		<base href="/Dynamic-Web-Project/">

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="assets/style.css">
	</head>
	<body>

		<?php if ($this->flash_message) { ?>
			<div class="flashMessage"><h4><?php echo $this->flash_message; ?></div>
		<?php } ?>

		<?php if ($this->flash_error) { ?>
			<div class="flashError"><h4><?php echo $this->flash_error; ?></div>
		<?php } ?>

		<header>
				<h1>VenYou</h1>

				<form action="search" method="get">
					<input type="text" name="" value="" placeholder="location">

					<label for="num_guests">Number of guests</label>
					<select class="" name="num_guests">
						<option value="0-20">Less than 20</option>
						<option value="20-40">20-40</option>
						<option value="40-60">40-60</option>
						<option value="60-100">60-100</option>
						<option value="100-150">100-150</option>
						<option value="150-200">150-200</option>
						<option value="200-250">200-250</option>
						<option value="250-500">250-500</option>
						<option value="500-1000">More than500</option>
					</select>
			</form>


				<nav>

				</nav>
		</header>

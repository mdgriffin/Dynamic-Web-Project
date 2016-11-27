<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $this->pageTitle; ?></title>
		<base href="/Dynamic-Web-Project/">

		<link href="https://fonts.googleapis.com/css?family=Nunito|Open+Sans" rel="stylesheet">
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

				<div class="header-topBar">

					<div class="container">

						<a href="" class="header-topBar-logo"><h1>VenYou</h1></a>

						<form action="search" method="get">

							<label for="location">Where</label>
							<div class="inputWrapper searchWrapper">
								<input type="text" name="location" value="" class="searchInput" placeholder="Location or venue name">
							</div>

							<label for="num_guests">Number of guests</label>

							<div class="inputWrapper selectWrapper">
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
							</div>
					</form>

					<div class="datePicker-container">

						<label for="date">Date</label>

						<div class="inputWrapper dateWrapper">
							<input type="text" name="date" value="" class="dateInput" id="dateInput" readonly>
						</div>

						<div class="datePicker-dropdown" id="datePicker-dropdown">
							<div class="datePicker" id="datePicker-header"></div>

							<button type="button" class="datePicker-btn" id="datePicker-prev"><span class="icon-left-open-big"></span></button>
							<button type="button" class="datePicker-btn" id="datePicker-next"><span class="icon-right-open-big"></span></button>
						</div>

					</div><!-- datePicker-container -->

				</div><!-- container -->

			</div><!-- header-topBar -->

			<div class="headerNavBar">

				<div class="container">

					<nav>
						<a href="#"><span class="icon-building"></span>Venues</a><!--
						--><a href="#"><span class="icon-gift"></span>Packages</a><!--
						--><a href="#"><span class="icon-map-marker"></span>Locations</a><!--
						--><a href="#"><span class="icon-news"></span>Blog</a><!--
						--><a href="#"><span class="icon-email"></span>Contact</a>
					</nav>

					<div class="headerNavBar-account">

						<?php if ($this->auth_admin) { ?>

							<button><span class="icon-user"></span><?php echo $this->auth_admin->getFullname(); ?><span class="icon-down-open-big"></span></button>

							<div class="headerNavBar-account-dropdown">

								<ul class="list-reset">
									<li><a href="admin">Admin Home</a></li>
									<li><a href="admin/venues">Manage Venues</a></li>
									<li><a href="admin/users">Manage Users</a></li>
									<li><a href="admin/bookings">Manage Bookings</a></li>
									<li><form action="admin/logout" method="post">
										<input type="submit" name="logout" value="Logout">
									</form></li>
								</ul>

							</div>

						<?php } else if ($this->auth_admin) { ?>



						<?php } else { ?>

							<a href="login"><button>Login</button></a>
							<a href="register"><button>Register</button></a>

						<?php } ?>


					</div>

				</div><!-- container -->

			</div><!-- headerNavBar -->

		</header>

		<div class="container">

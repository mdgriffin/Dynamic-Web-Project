<?php
session_start();

// only show if there is not a logged in user
if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]) {
	header('Location:index.php');
	die();
}

require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";
require_once "../app/models/User.php";

$pageTitle = "Please Login";

include_once("../partials/header.php");

// check if user is logged in
// if not redirect to login

if (isset($_POST["login"])) {
	if (User::isAdmin($_POST["email"], $_POST["password"])) {
		$_SESSION["admin_logged_in"] = true;
		header('Location:index.php');
	} else {
		echo "<h1>Not an admin</h1>";
	}
}

$errors = null;

if (isset($_POST["register"])) {
	$admin = new User($_POST["forename"], $_POST["surname"], $_POST["email"], $_POST["password"], 1);
	if (!$admin->errors()) {
		$admin->save();
	} else {
		$errors = $admin->errors();
	}
}


?>

<h1>Admin Login</h1>

<form action="login.php" method="post">

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" value="">
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="text" name="password" value="">
	</fieldset>

	<input type="submit" name="login" value="Login">

</form>


<h1>Register Admin</h1>

<form action="login.php" method="post">

	<fieldset>
		<label for="forename">First Name</label>
		<input type="text" name="forename" value="">
		<?php
		if ($errors && isset($errors["forename"])) {
			foreach ($errors["forename"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="surname">Surname</label>
		<input type="text" name="surname" value="">
		<?php
		if ($errors && isset($errors["surname"])) {
			foreach ($errors["surname"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" value="">
		<?php
		if ($errors && isset($errors["email"])) {
			foreach ($errors["email"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="text" name="password" value="">
		<?php
		if ($errors && isset($errors["password"])) {
			foreach ($errors["password"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<input type="submit" name="register" value="Register">

</form>


<?php include_once("../partials/footer.php"); ?>

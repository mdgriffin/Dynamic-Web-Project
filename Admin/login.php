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
require_once "../app/models/Admin.php";

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

if (isset($_POST["register"])) {
	$admin = new User($_POST["forename"], $_POST["surname"], $_POST["email"], $_POST["password"]);
	$admin->save();
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
	</fieldset>

	<fieldset>
		<label for="surname">Surname</label>
		<input type="text" name="surname" value="">
	</fieldset>

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" value="">
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="text" name="password" value="">
	</fieldset>

	<input type="submit" name="register" value="Register">

</form>


<?php include_once("../partials/footer.php"); ?>

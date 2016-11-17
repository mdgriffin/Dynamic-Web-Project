<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || !$_SESSION["admin_logged_in"]) {
	header('Location:login.php');
	die();
}

if ($_POST["logout"]) {
	session_destroy();
	header("Location:login.php");
}

require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";

$pageTitle = "Admin Index";

include_once("../partials/header.php");

?>

<h1>Admin Index: You are now logged in</h1>

<form action="index.php" method="post">
	<input type="submit" name="logout" value="Logout">
</form>

<?php include_once("partials/footer.php"); ?>

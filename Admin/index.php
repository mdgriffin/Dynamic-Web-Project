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
include_once("../partials/admin-nav.php");
?>

<h1>Admin Index: You are now logged in</h1>

<?php include_once("../partials/footer.php"); ?>

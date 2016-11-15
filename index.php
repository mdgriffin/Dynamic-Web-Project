<?php
require_once "app/config.php";
require_once "app/connection.php";
require_once "app/models/Model.php";
require_once "app/Validator.php";

$pageTitle = "Find the Perfect Venue";

include_once("partials/header.php");

?>

<nav>
	<a href="venues">Venues</a>
	<a href="admin">Admin</a>
</nav>

<h1>Home Page</h1>



<?php include_once("partials/footer.php"); ?>

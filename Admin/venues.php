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
require_once "../app/models/Venue.php";

$venues = Venue::getAll();

$pageTitle = "Manage Venues";

include_once("../partials/header.php");
include_once("../partials/admin-nav.php");
?>

<h1>Admin: Manage Venues</h1>

<h3>Register Venue</h3>

<form action="venues.php" method="post">
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" value="">
		<?php
		if ($errors && isset($errors["name"])) {
			foreach ($errors["name"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>
	<fieldset>
		<label for="address">Address</label>
		<textarea name="address"></textarea>
		<?php
 		if ($errors && isset($errors["address"])) {
 			foreach ($errors["address"] as $error) {
 		?>
 				<p class="form-error"><?php echo $error; ?></p>
 		<?php
 			}
 		}
 		?>
	</fieldset>
	<fieldset>
		<label for="description">Description</label>
		<textarea name="description"></textarea>
		<?php
		if ($errors && isset($errors["description"])) {
			foreach ($errors["description"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<input type="hidden" name="latitude" value="52.059935">
	<input type="hidden" name="longitude" value="-9.504427">

	<input type="submit" value="Register">
</form>


<h2>Venues</h2>

<table>
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Description</th>
		<th>Latitude</th>
		<th>longitude</th>
		<th colspan="2">Actions</th>
	</thead>
	<tbody>
		<?php foreach ($venues as $venue) { ?>
			<tr>
				<td><?php echo $venue["venue_id"]; ?></td>
				<td><?php echo $venue["name"]; ?></td>
				<td><?php echo $venue["address"]; ?></td>
				<td><?php echo $venue["description"]; ?></td>
				<td><?php echo $venue["latitude"]; ?></td>
				<td><?php echo $venue["longitude"]; ?></td>
				<td><a href="venues.php?venue-id=<?php echo $venue["venue_id"]; ?>"><button>Update</button></a></td>
				<td>
					<form action="venues.php" method="post">
						<input type="hidden" name="venue_id" value="<?php echo $venue["venue_id"]; ?>">
						<input type="submit" name="submit" value="Delete Venue">
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("../partials/footer.php"); ?>

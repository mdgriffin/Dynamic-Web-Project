<?php
require_once "app/config.php";
require_once "app/connection.php";
require_once "app/models/Model.php";
require_once "app/Validator.php";
require_once "app/models/Venue.php";

$errors = null;

if (isset($_POST["name"])) {
	$venue = new Venue($_POST["name"], $_POST["address"], $_POST["description"], $_POST["latitude"], $_POST["longitude"]);

	if (!$venue->errors()) {
		$venue->save();
	} else {
		$errors = $venue->errors();
	}
}

$venues = Venue::getAll();

$pageTitle = "Find the perfect venue";

include_once("partials/header.php");

?>

<h2>Hotels</h2>

<table>
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Description</th>
		<th>Latitude</th>
		<th>longitude</th>
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
			</tr>
		<?php } ?>
	</tbody>
</table>


<h3>Register Hotel</h3>

<form action="index.php" method="post">
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

<?php include_once("partials/footer.php"); ?>

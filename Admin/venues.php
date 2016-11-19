<?php
session_start();



if (isset($_POST["logout"])) {
	session_destroy();
	header("Location:login.php");
}

require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";
require_once "../app/models/Venue.php";

$errors = null;

// register venue
if (isset($_POST["register"])) {
	$venue = new Venue($_POST["name"], $_POST["address"], $_POST["description"], $_POST["latitude"], $_POST["longitude"]);

	if (!$venue->errors()) {
		$venue->save();
		$flash_message = "New Venue Created";
	} else {
		$errors = $venue->errors();
		$flash_error = "Form has errors";
	}
// delete venue
} else if (isset($_POST["delete"])) {
	Venue::delete($_POST["venue_id"]);
	$venue = new Venue("", "", "", "", "", "");
	$flash_message = "Venue Deleted";

} else if (isset($_GET["id"])) {
	$venue = Venue::get($_GET["id"]);

	// update venue
	if (isset($_POST["update"])) {
		$venue->setName($_POST["name"]);
		$venue->setAddress($_POST["address"]);
		$venue->setDescription($_POST["description"]);
		$venue->setLatitude($_POST["latitude"]);
		$venue->setLongitude($_POST["longitude"]);

		if (!$venue->errors()) {
			$venue->update();
			$flash_message = "Venue Updated";
		} else {
			$errors = $venue->errors();
			$flash_error = "Form has errors";
		}
	}
// empty register form
} else {
	$venue = new Venue("", "", "", "", "", "");
}

$venues = Venue::getAll();
$pageTitle = "Manage Venues";

include_once("../partials/header.php");
include_once("../partials/admin-nav.php");
?>

<h1>Admin: Manage Venues</h1>

<?php if (isset($_GET["id"])) { ?>
	<h3>Update Venue</h3>

	<form action="venues.php?id=<?php echo $_GET["id"]; ?>" method="post">
<?php } else {?>
	<h3>Register Venue</h3>

	<form action="venues.php" method="post">
<?php } ?>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" value="<?php echo $venue->getName(); ?>">
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
		<textarea name="address"><?php echo $venue->getAddress(); ?></textarea>
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
		<label for="latitude">Latitude</label>
		<input type="text" name="latitude" value="<?php echo $venue->getLatitude(); ?>">
	</fieldset>

	<fieldset>
		<label for="longitude">Longitude</label>
		<input type="text" name="longitude" value="<?php echo $venue->getLongitude(); ?>">
	</fieldset>

	<fieldset>
		<label for="description">Description</label>
		<textarea name="description"><?php echo $venue->getDescription(); ?></textarea>
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

	<?php if (isset($_GET["id"])) { ?>
		<input type="submit" name="update" value="Update">
	<?php } else {?>
		<input type="submit" name="register" value="Register">
	<?php } ?>

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
				<td><a href="venues.php?id=<?php echo $venue["venue_id"]; ?>"><button>Update</button></a></td>
				<td>
					<form action="venues.php" method="post">
						<input type="hidden" name="venue_id" value="<?php echo $venue["venue_id"]; ?>">
						<input type="submit" name="delete" value="Delete Venue">
					</form>
				</td>
				<td><a href="packages.php?id=<?php echo $venue["venue_id"]; ?>"><button>Manage Packages</button></a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("../partials/footer.php"); ?>

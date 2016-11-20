<?php

include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Venues</h1>

<?php if ($this->id) { ?>
	<h3>Update Venue</h3>

	<form action="venues.php?id=<?php echo $this->id; ?>" method="post">
<?php } else {?>
	<h3>Register Venue</h3>

	<form action="venues.php" method="post">
<?php } ?>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" value="<?php echo $this->venue->getName(); ?>">
		<?php
		if ($this->errors && isset($this->errors["name"])) {
			foreach ($this->errors["name"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="address">Address</label>
		<textarea name="address"><?php echo $this->venue->getAddress(); ?></textarea>
		<?php
 		if ($this->errors && isset($this->errors["address"])) {
 			foreach ($this->errors["address"] as $this->error) {
 		?>
 				<p class="form-error"><?php echo $this->error; ?></p>
 		<?php
 			}
 		}
 		?>
	</fieldset>

	<fieldset>
		<label for="latitude">Latitude</label>
		<input type="text" name="latitude" value="<?php echo $this->venue->getLatitude(); ?>">
	</fieldset>

	<fieldset>
		<label for="longitude">Longitude</label>
		<input type="text" name="longitude" value="<?php echo $this->venue->getLongitude(); ?>">
	</fieldset>

	<fieldset>
		<label for="description">Description</label>
		<textarea name="description"><?php echo $this->venue->getDescription(); ?></textarea>
		<?php
		if ($this->errors && isset($this->errors["description"])) {
			foreach ($this->errors["description"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<?php if ($this->id) { ?>
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
		<?php foreach ($this->venues as $venue) { ?>
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
						<input type="hidden" name="METHOD" value="DELETE">
						<input type="hidden" name="id" value="<?php echo $venue["venue_id"]; ?>">
						<input type="submit" name="delete" value="Delete Venue">
					</form>
				</td>
				<td><a href="packages.php?id=<?php echo $venue["venue_id"]; ?>"><button>Manage Packages</button></a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("app/views/partials/footer.php"); ?>

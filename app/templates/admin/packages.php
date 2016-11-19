<?php
$pageTitle = "Manage Packages";

include_once("../partials/header.php");
include_once("../partials/admin-nav.php");
?>

<h1>Admin: Manage Venue Packages for <?php echo $venue->getName(); ?></h1>

<?php if (isset($package_id)) { ?>
	<h3>Update Packages</h3>

	<form action="packages.php?id=<?php echo $venue_id; ?>%26package_id=<?php echo $package_id; ?>" method="post">
<?php } else {?>
	<h3>Create Package</h3>

	<form action="packages.php?id=<?php echo $venue_id; ?>" method="post">
<?php } ?>

	<input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>">

	<fieldset>
		<label for="name">Description</label>
		<input type="text" name="description" value="<?php echo $package->getDescription(); ?>">
		<?php
		if (isset($errors["description"]) && $errors) {
			foreach ($errors["description"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="price_per_guest">Price Per Guest</label>
		<input type="text" name="price_per_guest" value="<?php echo $package->getPrice_per_guest(); ?>">
		<?php
		if (isset($errors["price_per_guest"]) && $errors) {
			foreach ($errors["price_per_guest"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="min_guests">Minimum Number of Guests</label>
		<input type="text" name="min_guests" value="<?php echo $package->getMin_guests(); ?>">
		<?php
		if (isset($errors["min_guests"]) && $errors) {
			foreach ($errors["min_guests"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="max_guests">Maximum Number of Guests</label>
		<input type="text" name="max_guests" value="<?php echo $package->getMax_guests(); ?>">
		<?php
		if (isset($errors["max_guests"]) && $errors) {
			foreach ($errors["max_guests"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="start_date">Start Date</label>
		<input type="text" name="start_date" value="<?php echo $package->getStart_date(); ?>">
		<?php
		if (isset($errors["start_date"]) && $errors) {
			foreach ($errors["start_date"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="end_date">End Date</label>
		<input type="text" name="end_date" value="<?php echo $package->getEnd_date(); ?>">
		<?php
		if (isset($errors["end_date"]) && $errors) {
			foreach ($errors["end_date"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<?php if (isset($package_id)) { ?>
		<input type="submit" name="update" value="Update">
	<?php } else {?>
		<input type="submit" name="register" value="Register">
	<?php } ?>

</form>

<table>
	<thead>
		<tr>
			<th>IDd</th>
			<th>description</th>
			<th>Price Per Guest</th>
			<th>Min Guests</th>
			<th>Max Guests</th>
			<th>Start Date</th>
			<th>End Date</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($packages as $package) { ?>
				<tr>
					<td><?php echo $package["package_id"]; ?></td>
					<td><?php echo $package["description"]; ?></td>
					<td><?php echo $package["price_per_guest"]; ?></td>
					<td><?php echo $package["min_guests"]; ?></td>
					<td><?php echo $package["max_guests"]; ?></td>
					<td><?php echo $package["start_date"]; ?></td>
					<td><?php echo $package["end_date"]; ?></td>
				</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("../partials/footer.php"); ?>

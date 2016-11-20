<?php
include_once("app/templates/partials/header.php");
include_once("app/templates/partials/admin-nav.php");
?>

<h1>Admin: Manage Venue Packages for <?php echo $this->venue->getName(); ?></h1>

<?php if (isset($this->package_id)) { ?>
	<h3>Update Packages</h3>

	<form action="packages.php?id=<?php echo $this->venue_id; ?>%26package_id=<?php echo $this->package_id; ?>" method="post">
<?php } else {?>
	<h3>Create Package</h3>

	<form action="packages.php?id=<?php echo $this->venue_id; ?>" method="post">
<?php } ?>

	<input type="hidden" name="venue_id" value="<?php echo $this->venue_id; ?>">

	<fieldset>
		<label for="name">Description</label>
		<input type="text" name="description" value="<?php echo $this->package->getDescription(); ?>">
		<?php
		if (isset($this->errors["description"]) && $this->errors) {
			foreach ($this->errors["description"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="price_per_guest">Price Per Guest</label>
		<input type="text" name="price_per_guest" value="<?php echo $this->package->getPrice_per_guest(); ?>">
		<?php
		if (isset($this->errors["price_per_guest"]) && $this->errors) {
			foreach ($this->errors["price_per_guest"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="min_guests">Minimum Number of Guests</label>
		<input type="text" name="min_guests" value="<?php echo $this->package->getMin_guests(); ?>">
		<?php
		if (isset($this->errors["min_guests"]) && $this->errors) {
			foreach ($this->errors["min_guests"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="max_guests">Maximum Number of Guests</label>
		<input type="text" name="max_guests" value="<?php echo $this->package->getMax_guests(); ?>">
		<?php
		if (isset($this->errors["max_guests"]) && $this->errors) {
			foreach ($this->errors["max_guests"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="start_date">Start Date</label>
		<input type="text" name="start_date" value="<?php echo $this->package->getStart_date(); ?>">
		<?php
		if (isset($this->errors["start_date"]) && $this->errors) {
			foreach ($this->errors["start_date"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="end_date">End Date</label>
		<input type="text" name="end_date" value="<?php echo $this->package->getEnd_date(); ?>">
		<?php
		if (isset($this->errors["end_date"]) && $this->errors) {
			foreach ($this->errors["end_date"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<?php if (isset($this->package_id)) { ?>
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
		<?php foreach ($this->packages as $package) { ?>
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

<?php include_once("app/templates/partials/footer.php"); ?>

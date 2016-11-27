<?php
include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Venue Packages for <?php echo $this->venue->getName(); ?></h1>

<div class="card">

	<div class="gs">

		<div class="gs-col gs6">

			<?php if (isset($this->package_id)) { ?>
				<h2>Update Packages</h2>

				<form action="admin/packages.php?id=<?php echo $this->venue_id; ?>%26package_id=<?php echo $this->package_id; ?>" method="post" class="form">
			<?php } else {?>
				<h2>Create Package</h2>

				<form action="admin/packages.php?id=<?php echo $this->venue_id; ?>" method="post" class="form">
			<?php } ?>

				<input type="hidden" name="venue_id" value="<?php echo $this->venue_id; ?>">

				<fieldset>

					<input type="text" name="description" id="name" value="<?php echo $this->package->getDescription(); ?>"><!--
					--><label for="name" class="form-mainLabel">Description</label>
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

					<input type="text" name="price_per_guest" id="price_per_guest" value="<?php echo $this->package->getPrice_per_guest(); ?>"><!--
					--><label for="price_per_guest" class="form-mainLabel">Price Per Guest</label>
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
					<input type="text" name="min_guests" id="min_guests" value="<?php echo $this->package->getMin_guests(); ?>"><!--
					--><label for="min_guests" class="form-mainLabel">Minimum Number of Guests</label>
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

					<input type="text" name="max_guests" id="max_guests" value="<?php echo $this->package->getMax_guests(); ?>"><!--
					--><label for="max_guests" class="form-mainLabel">Maximum Number of Guests</label>
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

					<input type="text" name="start_date" id="start_date" value="<?php echo $this->package->getStart_date(); ?>"><!--
					--><label for="start_date" class="form-mainLabel">Start Date</label>
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

					<input type="text" name="end_date" id="end_date" value="<?php echo $this->package->getEnd_date(); ?>"><!--
					--><label for="end_date" class="form-mainLabel">End Date</label>
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
					<input type="submit" name="update" class="btn btn-primary btn-large" value="Update">
				<?php } else {?>
					<input type="submit" name="register" class="btn btn-primary btn-large" value="Register">
				<?php } ?>

			</form>

		</div><!-- gs-col -->

		<div class="gs-col gs6">

			<h2>Packages</h2>

			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
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

		</div><!-- gs-col -->

	</div><!-- gs -->

</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

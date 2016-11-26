<?php

include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Venues</h1>


<div class="card">

	<div class="gs">

		<div class="gs-col gs6 gs6-after">

			<?php if ($this->id) { ?>
				<h2>Update Venue</h2>

				<form action="admin/venues.php?id=<?php echo $this->id; ?>" class="form" method="post">
			<?php } else {?>
				<h2>Register Venue</h2>

				<form action="admin/venues.php" class="form" method="post">
			<?php } ?>
				<fieldset>

					<input type="text" name="name" value="<?php echo $this->venue->getName(); ?>"><!--
					--><label for="name" class="form-mainLabel">Name</label>
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
					<textarea name="address"><?php echo $this->venue->getAddress(); ?></textarea><!--
					--><label for="address" class="form-mainLabel">Address</label>
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

					<input type="text" name="latitude" value="<?php echo $this->venue->getLatitude(); ?>"><!--
					--><label for="latitude" class="form-mainLabel">Latitude</label>
				</fieldset>

				<fieldset>

					<input type="text" name="longitude" value="<?php echo $this->venue->getLongitude(); ?>"><!--
					--><label for="longitude" class="form-mainLabel">Longitude</label>
				</fieldset>

				<fieldset>

					<textarea name="description"><?php echo $this->venue->getDescription(); ?></textarea><!--
					--><label for="description" class="form-mainLabel">Description</label>
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
					<input type="submit" class="btn btn-primary btn-large" name="update" value="Update">
				<?php } else {?>
					<input type="submit" class="btn btn-primary btn-large" name="register" value="Register">
				<?php } ?>

			</form>

		</div><!-- gs-col -->

		<div class="gs-col gs12">

			<h2>Venues</h2>

			<table class="table">
				<thead>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Description</th>
					<th>Latitude</th>
					<th>longitude</th>
					<th>Actions</th>
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
							<td>
								<a href="admin/venues.php?id=<?php echo $venue["venue_id"]; ?>" class="btn btn-small btn-secondary btn-fullWidth">Update</a>
								<form action="admin/venues.php" method="post">
									<input type="hidden" name="METHOD" value="DELETE">
									<input type="hidden" name="id" value="<?php echo $venue["venue_id"]; ?>">
									<input type="submit" name="delete" value="Delete Venue" class="btn btn-small btn-secondary btn-fullWidth">
								</form>
								<a href="admin/packages.php?id=<?php echo $venue["venue_id"]; ?>" class="btn btn-small btn-secondary btn-fullWidth">Manage Packages</a>
								<a href="admin/venues/<?php echo $venue["venue_id"]; ?>/images" class="btn btn-small btn-secondary btn-fullWidth">Manage Venue Images</a>
							<td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div><!-- gs-col -->

	</div><!-- gs -->

</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

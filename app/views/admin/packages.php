<?php include_once("app/views/partials/header.php"); ?>

<h1>Admin: Manage Venue Packages for <?php echo $this->venue->getName(); ?></h1>

<div class="card">

	<div class="gs">

		<div class="gs-col gs6">

			<?php if ($this->package_id) { ?>
				<h2>Update Packages</h2>

				<form action="admin/packages?venue_id=<?php echo $this->venue_id; ?>&package_id=<?php echo $this->package_id; ?>" method="post" class="form">
			<?php } else {?>
				<h2>Create Package</h2>

				<form action="admin/packages?venue_id=<?php echo $this->venue_id; ?>" method="post" class="form">
			<?php } ?>

				<input type="hidden" name="venue_id" value="<?php echo $this->venue_id; ?>">

				<fieldset>
					<input type="text" name="title" id="title" value="<?php echo $this->package->getTitle(); ?>"><!--
					--><label for="title" class="form-mainLabel">Title</label>
					<?php
					if (isset($this->errors["title"]) && $this->errors) {
						foreach ($this->errors["title"] as $this->error) {
					?>
							<p class="form-error"><?php echo $this->error; ?></p>
					<?php
						}
					}
					?>
				</fieldset>

				<fieldset>
					<textarea name="description" placeholder="DESCRIPTION"><?php echo $this->package->getDescription(); ?></textarea>
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

				<fieldset class="form-datepicker">
					<input type="hidden" name="start_date" readonly id="start_date" value="<?php echo $this->package->getStart_date(); ?>">
					<input type="text" readonly id="start_date_display" value=""><!--
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

					<div class="datePicker-dropdown datePicker-dropdown-bottomLeft" id="start-datePicker-dropdown">
						<div class="datePicker" id="start_datepicker"></div>

						<button type="button" class="datePicker-btn datePicker-btn-prev" id="start-datePicker-prev"><span class="icon-left-open-big"></span></button>
						<button type="button" class="datePicker-btn datePicker-btn-next" id="start-datePicker-next"><span class="icon-right-open-big"></span></button>
					</div>
				</fieldset>

				<fieldset class="form-datepicker">
					<input type="hidden" name="end_date" readonly id="end_date" value="<?php echo $this->package->getEnd_date(); ?>">
					<input type="text" readonly id="end_date_display" value=""><!--
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

					<div class="datePicker-dropdown datePicker-dropdown-bottomLeft" id="end-datePicker-dropdown">
						<div class="datePicker" id="end_datepicker"></div>

						<button type="button" class="datePicker-btn datePicker-btn-prev" id="end-datePicker-prev"><span class="icon-left-open-big"></span></button>
						<button type="button" class="datePicker-btn datePicker-btn-next" id="end-datePicker-next"><span class="icon-right-open-big"></span></button>
					</div>
				</fieldset>

				<?php if ($this->package_id) { ?>
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
						<th>Title</th>
						<th>Price Per Guest</th>
						<th>Min Guests</th>
						<th>Max Guests</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->packages as $package) { ?>
							<tr>
								<td><?php echo $package["package_id"]; ?></td>
								<td><?php echo $package["title"]; ?></td>
								<td><?php echo $package["price_per_guest"]; ?></td>
								<td><?php echo $package["min_guests"]; ?></td>
								<td><?php echo $package["max_guests"]; ?></td>
								<td><?php echo $package["start_date"]; ?></td>
								<td><?php echo $package["end_date"]; ?></td>
								<td><a href="admin/packages?venue_id=<?php echo $this->venue_id; ?>&package_id=<?php echo $package["package_id"]; ?>" class="btn btn-small btn-secondary">Update</a></td>
								<td>
									<form action="admin/packages?venue_id=<?php echo $this->venue_id; ?>" method="post">
										<input type="hidden" name="METHOD" value="DELETE">
										<input type="hidden" name="package_id" value="<?php echo $package["package_id"]; ?>">
										<input type="submit" name="delete" value="Delete" class="btn btn-small btn-secondary">
									</form>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>

		</div><!-- gs-col -->

	</div><!-- gs -->

</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

<script type="text/javascript">


(function () {

	<?php
	if ($this->package->getStart_date()) {
		$date_parts = explode("-", $this->package->getStart_Date());
		echo "var startDate = new Date($date_parts[0], " . ((int)$date_parts[1] - 1)  . ", $date_parts[2]);";
	} else {
		echo "var startDate = new Date();";
	}

	if ($this->package->getEnd_date()) {
		$date_parts = explode("-", $this->package->getEnd_Date());
		echo "var endDate = new Date($date_parts[0], " . ((int)$date_parts[1] - 1)  . ", $date_parts[2]);";
	} else {
		echo "var endDate = new Date();";
	}

	?>

	var startCalendar = new InputCalendar({
		date: startDate,
		inputEl: document.getElementById("start_date"),
		displayInputEl: document.getElementById("start_date_display"),
		dropDownEl: document.getElementById("start-datePicker-dropdown"),
		nextBtnEl: document.getElementById("start-datePicker-next"),
		prevBtnEl: document.getElementById("start-datePicker-prev"),
		el: document.getElementById("start_datepicker"),
		disableBefore: new Date().setHours(0, 0, 0, 0), // disable before today
		disableAfter: new Date(Date.now() + 730 * 24 * 60 * 60 * 1000).getTime(), // disable after 2 years
	});

	var endCalendar = new InputCalendar({
		date: endDate,
		inputEl: document.getElementById("end_date"),
		displayInputEl: document.getElementById("end_date_display"),
		dropDownEl: document.getElementById("end-datePicker-dropdown"),
		nextBtnEl: document.getElementById("end-datePicker-next"),
		prevBtnEl: document.getElementById("end-datePicker-prev"),
		el: document.getElementById("end_datepicker"),
		disableBefore: new Date().setHours(0, 0, 0, 0), // disable before today
		disableAfter: new Date(Date.now() + 730 * 24 * 60 * 60 * 1000).getTime(), // disable after 2 years
	});

	})();

</script>

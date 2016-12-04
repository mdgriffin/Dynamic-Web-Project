<?php include_once("app/views/partials/header.php"); ?>

	<h1><?php echo $this->package->getTitle(); ?></h1>

	<div class="card">



		<div class="gs">

			<div class="gs-col gs6">

				<h2>Package Details</h2>

				<p><?php echo $this->package->getDescription(); ?></p>

			</div>

			<div class="gs-col gs6">

				<h2>Make a Booking</h2>

				<form class="form" action="packages/<?php echo $this->package->getPackage_id(); ?>" method="post">

					<fieldset>
						<input type="text" name="num_guests" id="num_guests" value="<?php echo $this->booking->getNum_guests(); ?>"><!--
						--><label for="num_guests" class="form-mainLabel">Number of Guests</label>
						<?php
						if ($this->errors && isset($this->errors["num_guests"])) {
							foreach ($this->errors["num_guests"] as $this->error) {
						?>
								<p class="form-error"><?php echo $this->error; ?></p>
						<?php
							}
						}
						?>
					</fieldset>

					<fieldset>
						<input type="text" name="event_date" id="event_date" value="<?php echo $this->booking->getEvent_date(); ?>"><!--
						--><label for="event_date" class="form-mainLabel">Event Date</label>
						<?php
						if ($this->errors && isset($this->errors["event_date"])) {
							foreach ($this->errors["event_date"] as $this->error) {
						?>
								<p class="form-error"><?php echo $this->error; ?></p>
						<?php
							}
						}
						?>
					</fieldset>

					<input type="submit" class="btn btn-primary btn-large" name="book_package" value="Book!">

				</form>

			</div><!-- gs-col -->

		</div><!-- gs -->

	</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

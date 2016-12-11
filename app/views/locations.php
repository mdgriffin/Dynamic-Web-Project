<?php include_once("app/views/partials/header.php"); ?>

	<h1>Venues by location</h1>

	<div class=" locations">

			<div class="gs">

				<div class="gs-col gs3 locations-list">

					<div class="card">

						<div class="locations-list fullWidth-cover" id="locations-list">

							<?php foreach ($this->venues as $venue) { ?>

									<div class="locations-list-single" id="location-<?php echo $venue["venue_id"]; ?>" data-venue-id="<?php echo $venue["venue_id"]; ?>">

										<h3><?php echo $venue["name"]; ?></h3>

									</div>

							<?php } ?>

						</div><!-- locations-list -->

					</div><!-- card -->

				</div><!-- gs-col -->

				<div class=" gs-col gs9">

					<div class="locations-mapContainer">
						<div class="locations-map-venue-container" id="locations-map-venue-container">
							<div class="locations-map-venue" id="locations-map-venue"></div>
						</div>
						<div class="locations-map" id="map"></div>
					</div>

				</div><!-- locations-map -->

			</div><!-- gs -->

	</div><!-- card -->

	<script>
		// Global Variables
		var globs = {};
		globs.locations = [];

		<?php foreach ($this->venues as $venue) { ?>
			globs.locations.push({marker: null, el: null, id: <?php echo $venue["venue_id"]; ?>, latlng:{lat: <?php echo $venue["latitude"]; ?>, lng: <?php echo $venue["longitude"]; ?>}});
		<?php } ?>
	</script>

<?php include_once("app/views/partials/footer.php"); ?>

<?php include_once("app/views/partials/header.php"); ?>

	<h1><?php echo $this->venue->getName(); ?></h1>

	<div class="card">

			<p><?php echo $this->venue->getDescription(); ?></p>

			<h3>Images</h3>

			<div class="gs">

					<?php foreach ($this->images as $image) { ?>

						<div class="gs-col gs3 venueSingle-image">

							<img src="<?php echo Image::getSize($image['source'], 'medium_square'); ?>" alt="<?php echo $image['title']; ?>" />

							</div><!-- gs-col -->

					<?php } ?>

			</div><!-- gs -->

			<div class="gs">

				<div class="gs-col gs6">

					<h3>Location</h3>

					<div id="map" class="venueSingle-map"></div>

				</div><!-- gs-col -->

			</div><!-- gs -->

			<!-- TODO Show images, map and packages -->

	</div><!-- card -->

	<script>
		function initMap() {
			var venueLoc = {lat: <?php echo $this->venue->getLatitude(); ?>, lng: <?php echo $this->venue->getLongitude(); ?>};
			var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: venueLoc
		});
		var marker = new google.maps.Marker({
			position: venueLoc,
			map: map
		});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbgC6kK0wUhX1WExJo7Qavhx-UWp94xvE&callback=initMap"></script>

<?php include_once("app/views/partials/footer.php"); ?>

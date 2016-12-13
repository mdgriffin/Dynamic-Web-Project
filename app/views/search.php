<?php include_once("app/views/partials/header.php"); ?>

	<h1>Search Results: <?php echo count($this->results); ?> results found</h1>

		<?php foreach($this->results as $result) { ?>

			<div class="card search-result">

				<div class="card">

					<h2><?php echo $result["name"]; ?></h2>

					<h3><?php echo $result["title"]; ?></h3>

					<h4>Price Per Guest: <?php echo $result["price_per_guest"]; ?></h4>

					<p>Venue Description: <?php echo $result["venue_description"]; ?></p>

					<p>Package Description: <?php echo $result["package_description"]; ?></p>


					<div class="gs">

						<div class="gs-col gs-small12  gs-medium2">
							<a href="venues/<?php echo $result["venue_id"]; ?>" class="btn btn-medium btn-primary btn-fullWidth">View Venue</a>
						</div><!-- gs-col -->

						<div class="gs-col gs-small12 gs-medium2">
							<a href="packages/<?php echo $result["package_id"]; ?>" class="btn btn-medium btn-primary btn-fullWidth">Book Package</a>
						</div><!-- gs-col -->


					</div><!-- gs -->




				</div><!-- card -->

			</div><!-- search-result -->

		<?php } ?>

<?php include_once("app/views/partials/footer.php"); ?>

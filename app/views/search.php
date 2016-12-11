<?php include_once("app/views/partials/header.php"); ?>

	<h1>Search Results: <?php echo count($this->results); ?> results found</h1>

	<div class="card search">

		<?php foreach($this->results as $result) { ?>

			<div class="search-result">

				<h2><?php echo $result["name"]; ?></h2>

				<h3><?php echo $result["title"]; ?></h3>

				<p>Venue Description: <?php echo $result["venue_description"]; ?></p>

				<p>package Description: <?php echo $result["package_description"]; ?></p>

				<p>Price Per Guest: <?php echo $result["price_per_guest"]; ?></p>

				<a href="venues/<?php echo $result["venue_id"]; ?>" class="btn btn-medium btn-primary">View Venue</a>
				<a href="packages/<?php echo $result["package_id"]; ?>" class="btn btn-medium btn-primary">Book Package</a>

			</div><!-- search-result -->

		<?php } ?>

	</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

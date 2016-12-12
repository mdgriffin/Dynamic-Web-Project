<?php include_once("app/views/partials/header.php"); ?>

</div><!-- container -->

	<div class="home-banner">
			<img src="Assets/images/banner1.png" class="cardBannerImage-cover" alt="">
	</div><!-- card -->

<div class="container">

	<div class="card home-card">
		<h3>Find the perfect venue, whatever the occasion</h3>
	</div><!-- card -->

	<h2>Featured Venues</h2>

	<div class="gs">

		<?php foreach ($this->featured_venues as $venue) { ?>

			<div class="gs-col gs4 venues-single">

				<a href="venues/<?php echo $venue['venue_id']; ?>"><div class="card">

					<div class="fullWidth-top">
						<img  src="<?php echo Image::getSize($venue["source"], "banner"); ?>" title="<?php echo $venue["title"]; ?>" />
					</div>

					<h3><?php echo $venue["name"]; ?></h3>

					<p><?php echo $venue["description"]; ?>

				</div><!-- card --></a>

		</div><!-- gs-col -->

		<?php } ?>

	</div><!-- gs -->

<?php include_once("app/views/partials/footer.php"); ?>

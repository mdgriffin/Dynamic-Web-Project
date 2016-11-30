<?php
include_once("app/views/partials/header.php");
?>

	<h1>Venue Index</h1>

	<div class="gs">

		<?php foreach ($this->venues as $venue) { ?>

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

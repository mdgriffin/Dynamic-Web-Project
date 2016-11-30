<?php include_once("app/views/partials/header.php"); ?>


	<h1><?php echo $this->venue->getName(); ?></h1>

	<div class="card">

			<p><?php echo $this->venue->getDescription(); ?></p>


			<!-- TODO Show images, map and packages -->

	</div><!-- card -->


<?php include_once("app/views/partials/footer.php"); ?>

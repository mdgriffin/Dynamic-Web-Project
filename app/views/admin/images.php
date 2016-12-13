<?php include_once("app/views/partials/header.php"); ?>

<h1>Admin: Manage Venue Images for <?php echo $this->venue->getName(); ?></h1>

<div class="card">

	<div class="gs">

		<div class="gs-col  gs-small12 gs-medium6">

			<form action="admin/venues/<?php echo $this->venue_id; ?>/images" class="form" method="post" enctype="multipart/form-data">

				<fieldset>

					<input type="text" name="title" id="title" value="<?php $this->image->getTitle(); ?>"><!--
					--><label for="title" class="form-mainLabel">Image Title</label>
					<?php
					if (isset($this->errors["title"]) && $this->errors) {
						foreach ($this->errors["title"] as $error) {
					?>
							<p class="form-error"><?php echo $error; ?></p>
				<?php
						}
					}
				?>
				</fieldset>

				<fieldset>

					<input type="file" name="image_file" id="image_file" accept="image/*"><!--
					--><label for="image_file" class="form-mainLabel">Upload Image</label>
				</fieldset>

				<input type="submit" class="btn btn-primary btn-large">

			</form>

		</div><!-- gs-col -->

		<div class="gs-col  gs-small12 gs-medium6">

			<table class="table">
				<thead>
					<tr>
						<th>Image ID</td>
						<th>Image</th>
						<th>Actions</th>
					</tr>
				</thead>
			  <tbody>
					<?php foreach($this->venue_images as $venue_image)  { ?>
						<tr>
							<td><?php echo $venue_image["image_id"]; ?></td>
							<td>
								<a href="<?php echo $venue_image["source"]; ?>">
									<img src="<?php echo Image::getSize($venue_image['source'], 'thumbnail'); ?>" alt="<?php echo $venue_image["title"]; ?>" title="<?php echo $venue_image["title"]; ?>">
								<a/>
							</td>
							<td>
								<form action="admin/venues/<?php echo $this->venue_id; ?>/images"  method="post">
									<input type="hidden" name="METHOD" value="DELETE">
									<input type="hidden" name="source" value="<?php echo $venue_image['source']; ?>">
									<input type="hidden" name="image_id" value="<?php echo $venue_image["image_id"];; ?>">
									<input type="submit" name="delete" class="btn btn-small btn-secondary" value="Delete Image">
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

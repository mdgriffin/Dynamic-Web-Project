<?php include_once("app/views/partials/header.php"); ?>

	<h1>All Packages</h1>

	<div class="card">

		<table class="table">

			<thead>
				<tr>
					<th>Package Name</th>
					<th>Venue</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Price Per Guest</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($this->packages as $package) { ?>

					<tr>
						<td><?php echo $package["title"]; ?></td>
						<td><?php echo $package["venue_name"]; ?></td>
						<td><?php echo $package["start_date"]; ?></td>
						<td><?php echo $package["end_date"]; ?></td>
						<td><?php echo $package["price_per_guest"]; ?></td>
						<td><a href="packages/<?php echo $package['package_id']; ?>" class="btn btn-medium btn-secondary">Book</a></td>
					</tr>

				<?php } ?>

			</tbody>

		</table>


	</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

<?php include_once("app/views/partials/header.php"); ?>

<h1>Latest Bookings: <?php echo count($this->bookings); ?></h1>

<div class="card">

	<table class="table">

		<thead>
			<tr>
				<th>Venue</th>
				<th>Booked By</th>
				<th>Booking Date</td>
				<th>Num Guests</th>
				<th>Total Costs</th>
				<th>Package Name</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($this->bookings as $booking) { ?>

					<tr>
							<td><?php echo $booking["venue_name"]; ?></td>
							<td><?php echo $booking["forename"] . " " . $booking["surname"]; ?></td>
							<td><?php echo $booking["booking_date"]; ?></td>
							<td><?php echo $booking["num_guests"]; ?></td>
							<td><?php echo $booking["total"]; ?></td>
							<td><?php echo $booking["package_name"]; ?></td>
					</tr>

			<?php } ?>

		</tbody>

	</table>

</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

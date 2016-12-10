<?php include_once("app/views/partials/header.php"); ?>

	<h1>Your Bookings</h1>

	<div class="card">

		<table class="table">

			<thead>
				<tr>
					<th>Booking Date</th>
					<th>Event Date</th>
					<th>Venue Name</th>
					<th>Package Name</th>
					<th>Total Price</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach($this->bookings as $booking) { ?>

					<tr>
						<td><?php echo $booking["booking_date"]; ?></td>
						<td><?php echo $booking["event_date"]; ?></td>
						<td><?php echo $booking["venue_name"]; ?></td>
						<td><?php echo $booking["package_name"]; ?></td>
						<td><?php echo $booking["total"]; ?></td>
					</tr>

				<?php } ?>

			</tbody>

		</table>

	</div><!-- card-->

<?php include_once("app/views/partials/footer.php"); ?>

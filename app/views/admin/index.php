<?php include_once("app/views/partials/header.php"); ?>

	<h1>Admin</h1>

	<div class="gs">

		<div class="gs-col gs-small12 gs-medium6 gs-large3">

			<div class="card card-spaced">

				<table class="table">
					<thead>
						<th colspan="2">Booking Statistics</th>
					</thead>
					<tbody>
						<tr>
							<td>Number of Bookings</td>
							<td><?php echo $this->booking_stats["num_bookings"]; ?></td>
						</tr>
						<tr>
							<td>Total Booking Cost</td>
							<td><?php echo number_format($this->booking_stats["total_booking_cost"], 2); ?></td>
						</tr>
						<tr>
							<td>Average Booking Cost</td>
							<td><?php echo number_format($this->booking_stats["average_booking_cost"], 2); ?></td>
						</tr>
					</tbody>
				</table>

			</div><!-- card -->

		</div><!-- gs-col -->

		<div class="gs-col gs-small12 gs-medium6 gs-large3">

			<div class="card  card-spaced">

				<table class="table">

					<thead>
						<th colspan="2">Venue Statistics</th>
					</thead>
					<tbody>
						<tr>
							<td>Number of Venues</td>
							<td><?php echo $this->venue_stats["num_venues"]; ?></td>
						</tr>
						<tr>
							<td>Highest Grossing Venue</td>
							<td><a href="admin/venues?id=<?php echo $this->venue_stats["venue_id"]; ?>"><?php echo $this->venue_stats["highest_selling_venue"]; ?></a></td>
						</tr>
					</tbody>

				</table>

			</div><!-- card -->

		</div><!-- gs-col -->

		<div class="gs-col gs-small12 gs-medium6 gs-large3">

			<div class="card  card-spaced">

				<table class="table">

					<thead>
						<th colspan="2">User Statistics</th>
					</thead>
					<tbody>
						<tr>
							<td>Number of Registered Users</td>
							<td><?php echo $this->user_stats["num_users"]; ?></td>
						</tr>
						<tr>
							<td>Best Customer</td>
							<td><a href="admin/users?id=<?php echo $this->user_stats["user_id"]; ?>"><?php echo $this->user_stats["best_customer"]; ?></a></td>
						</tr>
					</tbody>

				</table>

			</div><!-- card -->

		</div><!-- gs-col -->

		<div class="gs-col gs-small12 gs-medium6 gs-large3">

			<div class="card  card-spaced">

				<table class="table">

					<thead>
						<th colspan="2">Package Statistics</th>
					</thead>
					<tbody>
						<tr>
							<td>Number of Packages</td>
							<td><?php echo $this->package_stats["num_packages"]; ?></td>
						</tr>
						<tr>
							<td>Most Popular Package:</td>
							<td><a href="admin/packages?venue_id=<?php echo $this->package_stats["venue_id"]; ?>&package_id=<?php echo $this->package_stats["package_id"]; ?>"><?php echo $this->package_stats["most_popular_package"]; ?></a></td>
						</tr>
					</tbody>

				</table>

			</div><!-- card -->

		</div><!-- gs-col -->

	</div><!-- gs -->

	<h2>Latest Bookings</h2>

	<div class="card  card-spaced">

		<table class="table">

			<thead>
				<tr>
					<th>Venue</th>
					<th>Package Name</th>
					<th>Booked By</th>
					<th>Event Date</td>
					<th>Booking Date</td>
					<th>Num Guests</th>
					<th>Total Costs</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($this->latest_bookings as $booking) { ?>

						<tr>
								<td><?php echo $booking["venue_name"]; ?></td>
									<td><?php echo $booking["package_name"]; ?></td>
								<td><?php echo $booking["forename"] . " " . $booking["surname"]; ?></td>
								<td><?php echo $booking["event_date"]; ?></td>
								<td><?php echo $booking["booking_date"]; ?></td>
								<td><?php echo $booking["num_guests"]; ?></td>
								<td><?php echo $booking["total"]; ?></td>
						</tr>

				<?php } ?>

			</tbody>

		</table>

	</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

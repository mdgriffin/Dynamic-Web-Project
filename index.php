<?php
require_once "app/connection.php";
require_once "app/models/Model.php";
require_once "app/models/Venue.php";

/*

$count = $db->exec("INSERT INTO Users (forename, surname) VALUES('Michael', 'Griffin')");

*/

//$users = $db->query("SELECT * FROM Users");

//$brehon = new Venue("Brehon", "Killarney, Co. Kerry", "Luxury Hotel in the heart of Killarney", 52.059935, -9.504427);
//$brehon->save();

//$malton = new Venue("Malton", "Killarney, Co. Kerry", "Killarney National Park just a short stroll away", 52.059935, -9.504427);
//$malton->save();

//$gleneagle = new Venue("Gleneagle", "Mucross Road Killarney, Co.Kerry", "Killarney's premier events hotel", 39.045270, -104.824423);
//$gleneagle->save();
//$gleneagle->setDescription("Killarey's finest music and events destination");
//$gleneagle->update();

$venues = Venue::getAll();
//$hotel_single = Hotel::get(10);

$pageTitle = "Find the perfect venue";

include_once("partials/header.php");

?>

<h2>Hotels</h2>

<table>
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Description</th>
		<th>Latitude</th>
		<th>longitude</th>
	</thead>
	<tbody>
		<?php foreach ($venues as $venue) { ?>
			<tr>
				<td><?php echo $venue["venue_id"]; ?></td>
				<td><?php echo $venue["name"]; ?></td>
				<td><?php echo $venue["address"]; ?></td>
				<td><?php echo $venue["description"]; ?></td>
				<td><?php echo $venue["latitude"]; ?></td>
				<td><?php echo $venue["longitude"]; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include_once("partials/footer.php");
?>

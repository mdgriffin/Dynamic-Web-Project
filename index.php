<?php
require_once "app/connection.php";
require_once "app/models/hotel.php";

/*

$count = $db->exec("INSERT INTO Users (forename, surname) VALUES('Michael', 'Griffin')");

*/

$users = $db->query("SELECT * FROM Users");

//$brehon = new Hotel("Brehon", "Killarney, Co. Kerry", "Luxury Hotel in the heart of Killarney", 52.059935, -9.504427);
//$brehon->save();

//$malton = new Hotel("Malton", "Killarney, Co. Kerry", "Killarney National Park just a short stroll away", 52.059935, -9.504427);
//$malton->save();

//$gleneagle = new Hotel("Gleneagle", "Mucross Road Killarney, Co.Kerry", "Killarney's premier events hotel", 39.045270, -104.824423);
//$gleneagle->save();
//$gleneagle->setDescription("Killarey's finest music and events destination");
//$gleneagle->update();

$hotels = Hotel::getAll();
//$hotel_single = Hotel::get(10);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

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
				<?php foreach ($hotels as $hotel) { ?>
					<tr>
						<td><?php echo $hotel["hotel_id"]; ?></td>
						<td><?php echo $hotel["name"]; ?></td>
						<td><?php echo $hotel["address"]; ?></td>
						<td><?php echo $hotel["description"]; ?></td>
						<td><?php echo $hotel["latitude"]; ?></td>
						<td><?php echo $hotel["longitude"]; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	</body>
</html>

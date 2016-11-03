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

$gleneagle = new Hotel("Gleneagle", "Mucross Road Killarney, Co.Kerry", "Killarney's premier events hotel", 39.045270, -104.824423);
$gleneagle->save();
$gleneagle->setDescription("Killarey's finest music and events destination");
$gleneagle->update();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

		<h2>Users</h2>

		<table>
			<thead>
				<th>ID</th>
				<th>Forename</th>
				<th>Surname</th>
			</thead>
			<tbody>
				<?php foreach ($users as $user) { ?>
					<tr>
						<td><?php echo $user["user_id"]; ?></td>
						<td><?php echo $user["forename"]; ?></td>
						<td><?php echo $user["surname"]; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	</body>
</html>

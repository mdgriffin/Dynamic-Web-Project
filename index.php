<?php
require_once "app/connection.php";

/*

$count = $db->exec("INSERT INTO Users (forename, surname) VALUES('Michael', 'Griffin')");

*/

$users = $db->query("SELECT * FROM Users");

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

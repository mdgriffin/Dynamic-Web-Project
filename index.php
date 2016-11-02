<?php
$db = "DynamicProject";
$user = "root";
$pass = "root";
$server = "mysql:host=localhost;dbname=$db";

try {
	$connection = new PDO ($server, $user, $pass);
	$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
	die(print_r($e));
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

		<h2>Hello World</h2>

	</body>
</html>

<?php

$db_database = "DynamicProject";
$db_user = "root";
$db_pass = "root";
$db_connection_string = "mysql:host=localhost;dbname=$db_database";

try {
	$db = new PDO ($db_connection_string, $db_user, $db_pass);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
	die(print_r($e));
}

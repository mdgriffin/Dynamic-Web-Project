<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || !$_SESSION["admin_logged_in"]) {
	header('Location:login.php');
	die();
}

if (isset($_POST["logout"])) {
	session_destroy();
	header("Location:login.php");
}

require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";
require_once "../app/models/User.php";

$errors = null;

// register user
if (isset($_POST["register"])) {
	$user = new User($_POST["forename"], $_POST["surname"], $_POST["email"], $_POST["password"], 1);

	if (!$user->errors()) {
		$user->save();
		$flash_message = "New User Created";
	} else {
		$errors = $user->errors();
		$flash_error = "Register User form has errors";
	}

	$user = new User("", "", "", "", 0);
// delete user
} else if (isset($_POST["delete"])) {
	User::delete($_POST["user_id"]);
	$user = new User("", "", "", "", "", 0);
	$flash_message = "User Deleted";
// update user
} else if (isset($_GET["id"])) {
	$user = User::get($_GET["id"]);

	$user->setPassword("");

	// update user
	if (isset($_POST["update"])) {
		$user->setForename($_POST["forename"]);
		$user->setSurname($_POST["surname"]);
		$user->setEmail($_POST["email"]);
		$user->setPassword($_POST["password"]);

		if (!$user->errors()) {
			$user->update();
			$flash_message = "User Updated";
		} else {
			$errors = $user->errors();
			$flash_error = "Form has errors";
		}
	}
// empty register form
} else {
	$user = new User("", "", "", "", 0);
}

$users = User::getAll();
$pageTitle = "Manage Users";

include_once("../partials/header.php");
include_once("../partials/admin-nav.php");
?>

<h1>Admin: Manage Users</h1>

<?php if (isset($_GET["id"])) { ?>
	<h3>Update User</h3>

	<form action="users.php?id=<?php echo $_GET["id"]; ?>" method="post">
<?php } else {?>
	<h3>Register User</h3>

	<form action="users.php" method="post">
<?php } ?>

	<fieldset>
		<label for="forename">First Name</label>
		<input type="text" name="forename" value="<?php echo $user->getForename(); ?>">
		<?php
		if ($errors && isset($errors["forename"])) {
			foreach ($errors["forename"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="surname">Surname</label>
		<input type="text" name="surname" value="<?php echo $user->getSurname(); ?>">
		<?php
		if ($errors && isset($errors["surname"])) {
			foreach ($errors["surname"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" autocomplete="off" value="<?php echo $user->getEmail(); ?>">
		<?php
		if ($errors && isset($errors["email"])) {
			foreach ($errors["email"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="password" name="password" autocomplete="off" value="<?php echo $user->getPassword(); ?>">
		<?php
		if ($errors && isset($errors["password"])) {
			foreach ($errors["password"] as $error) {
		?>
				<p class="form-error"><?php echo $error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>

		<label for="is_admin">Admin User</label>
		<label><input type="radio" name="is_admin" value="1" <?php echo ((int)$user->getIs_admin() == 1? "checked" : ""); ?>> Yes</label>
		<label><input type="radio" name="is_admin" value="0" <?php echo ((int)$user->getIs_admin() == 0? "checked" : ""); ?>> No</label>


	</fieldset>

	<?php if (isset($_GET["id"])) { ?>
		<input type="submit" name="update" value="Update">
	<?php } else {?>
		<input type="submit" name="register" value="Register">
	<?php } ?>

</form>

<h2>Users</h2>

<table>
	<thead>
		<th>ID</th>
		<th>Forename</th>
		<th>Surname</th>
		<th>Email</th>
		<th>Admin User</th>
		<th colspan="2">Actions</th>
	</thead>
	<tbody>
		<?php foreach ($users as $user) { ?>
			<tr>
				<td><?php echo $user["user_id"]; ?></td>
				<td><?php echo $user["forename"]; ?></td>
				<td><?php echo $user["surname"]; ?></td>
				<td><?php echo $user["email"]; ?></td>
				<td><?php echo ((int)$user["is_admin"] == 1? "Yes": "No "); ?></td>
				<td><a href="users.php?id=<?php echo $user["user_id"]; ?>"><button>Update</button></a></td>
				<td>
					<form action="users.php" method="post">
						<input type="hidden" name="user_id" value="<?php echo $user["user_id"]; ?>">
						<input type="submit" name="delete" value="Delete User">
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("../partials/footer.php"); ?>

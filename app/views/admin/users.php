<?php
include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Users</h1>

<?php if ($this->user_id) { ?>
	<h3>Update User</h3>

	<form action="users.php?id=<?php echo $this->user_id; ?>" method="post">
<?php } else {?>
	<h3>Register User</h3>

	<form action="users.php" method="post">
<?php } ?>

	<fieldset>
		<label for="forename">First Name</label>
		<input type="text" name="forename" value="<?php echo $this->user->getForename(); ?>">
		<?php
		if ($this->errors && isset($this->errors["forename"])) {
			foreach ($this->errors["forename"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="surname">Surname</label>
		<input type="text" name="surname" value="<?php echo $this->user->getSurname(); ?>">
		<?php
		if ($this->errors && isset($this->errors["surname"])) {
			foreach ($this->errors["surname"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" autocomplete="off" value="<?php echo $this->user->getEmail(); ?>">
		<?php
		if ($this->errors && isset($this->errors["email"])) {
			foreach ($this->errors["email"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="password" name="password" autocomplete="off" value="<?php echo $this->user->getPassword(); ?>">
		<?php
		if ($this->errors && isset($this->errors["password"])) {
			foreach ($this->errors["password"] as $this->error) {
		?>
				<p class="form-error"><?php echo $this->error; ?></p>
		<?php
			}
		}
		?>
	</fieldset>

	<fieldset>

		<label for="is_admin">Admin User</label>
		<label><input type="radio" name="is_admin" value="1" <?php echo ((int)$this->user->getIs_admin() == 1? "checked" : ""); ?>> Yes</label>
		<label><input type="radio" name="is_admin" value="0" <?php echo ((int)$this->user->getIs_admin() == 0? "checked" : ""); ?>> No</label>


	</fieldset>

	<?php if ($this->user_id) { ?>
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
		<?php foreach ($this->users as $user) { ?>
			<tr>
				<td><?php echo $user["user_id"]; ?></td>
				<td><?php echo $user["forename"]; ?></td>
				<td><?php echo $user["surname"]; ?></td>
				<td><?php echo $user["email"]; ?></td>
				<td><?php echo ((int)$user["is_admin"] == 1? "Yes": "No "); ?></td>
				<td><a href="users.php?id=<?php echo $user["user_id"]; ?>"><button>Update</button></a></td>
				<td>
					<form action="users.php" method="post">
						<input type="hidden" name="METHOD" value="DELETE">
						<input type="hidden" name="id" value="<?php echo $user["user_id"]; ?>">
						<input type="submit" name="delete" value="Delete User">
					</form>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include_once("app/views/partials/footer.php"); ?>

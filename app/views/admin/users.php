<?php
include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Users</h1>

<div class="card">

<div class="gs">

	<div class="gs-col gs6">

			<?php if ($this->user_id) { ?>
				<h2>Update User</h2>

				<form action="admin/users?id=<?php echo $this->user_id; ?>" class="form" method="post">
			<?php } else {?>
				<h2>Register User</h2>

				<form action="admin/users" class="form" method="post">
			<?php } ?>

				<fieldset>
					<input type="text" name="forename" id="forename" value="<?php echo $this->user->getForename(); ?>"><!--
					--><label for="forename" class="form-mainLabel">First Name</label>
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
					<input type="text" name="surname" id="surname" value="<?php echo $this->user->getSurname(); ?>"><!--
					--><label for="surname" class="form-mainLabel">Surname</label>

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
					<input type="text" name="email" id="email" autocomplete="off" value="<?php echo $this->user->getEmail(); ?>"><!--
					--><label for="email" class="form-mainLabel">Email</label>
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
					<input type="password" name="password" id="password" autocomplete="off" value="<?php echo $this->user->getPassword(); ?>"><!--
					--><label for="password" class="form-mainLabel">Password</label>
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

					<div class="form-boxedInput">
						<label><input type="radio" name="is_admin" value="1" <?php echo ((int)$this->user->getIs_admin() == 1? "checked" : ""); ?>> Yes</label>
						<label><input type="radio" name="is_admin" value="0" <?php echo ((int)$this->user->getIs_admin() == 0? "checked" : ""); ?>> No</label>
					</div><!--
					--><label for="is_admin" class="form-mainLabel">Admin User</label>

				</fieldset>

				<?php if ($this->user_id) { ?>
					<input type="submit" class="btn btn-primary btn-large" name="update" value="Update">
				<?php } else {?>
					<input type="submit" class="btn btn-primary btn-large" name="register" value="Register">
				<?php } ?>

			</form>

		</div><!-- gs-col -->

		<div class="gs-col gs6">

			<h2>Users</h2>

			<table class="table">
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
							<td><a href="admin/users?id=<?php echo $user["user_id"]; ?>"><button class="btn btn-small btn-secondary">Update</button></a></td>
							<td>
								<form action="admin/users.php" method="post">
									<input type="hidden" name="METHOD" value="DELETE">
									<input type="hidden" name="id" value="<?php echo $user["user_id"]; ?>">
									<input type="submit" name="delete" value="Delete User" class="btn btn-small btn-secondary">
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div><!-- gs-col -->

	</div><!-- gs -->

</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

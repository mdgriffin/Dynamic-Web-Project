<?php include_once("app/views/partials/header.php"); ?>

<h1>Admin Login</h1>

<form action="admin/login.php" method="post">

	<fieldset>
		<label for="email">Email</label>
		<input type="text" name="email" value="">
	</fieldset>

	<fieldset>
		<label for="password">Password</label>
		<input type="text" name="password" value="">
	</fieldset>

	<input type="submit" name="login" value="Login">

</form>

<?php include_once("app/views/partials/footer.php"); ?>

<?php include_once("app/views/partials/header.php"); ?>

<div class="gs">

	<div class="gs-col gs4 gs4-before">

		<h1>Admin Login</h1>

		<div class="card">

			<form action="admin/login" class="form" method="post">

				<fieldset>

					<input type="text" name="email" id="email" value=""><!--
					--><label for="email" class="form-mainLabel">Email</label>
				</fieldset>

				<fieldset>

					<input type="password" name="password" id="password" value=""><!--
					--><label for="password" class="form-mainLabel">Password</label>
				</fieldset>

				<input type="submit" name="login" value="Login" class="btn btn-primary btn-large">

			</form>

		</div><!-- card -->

	</div><!-- gs-col -->

</div><!-- gs -->

<?php include_once("app/views/partials/footer.php"); ?>

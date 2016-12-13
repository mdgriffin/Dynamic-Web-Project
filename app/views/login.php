<?php
include_once("app/views/partials/header.php");
?>

<div class="gs">

	<div class="gs-col gs-small12 gs-medium8 gs-medium2-before gs-large4 gs-large4-before">

		<h1>Log In</h1>

		<div class="card">

			<form action="login" class="form" method="post">

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

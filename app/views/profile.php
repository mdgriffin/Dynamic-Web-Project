<?php include_once("app/views/partials/header.php"); ?>

	<div class="gs">

		<div class="gs-col gs-small12 gs-medium8 gs-medium2-before gs-large6 gs-large3-before">

			<h1>Manage Profile</h1>

			<div class="card">

				<form action="profile" class="form" method="post">

					<fieldset>
						<input type="text" name="forename" id="forename" value="<?php echo $this->auth_user->getForename(); ?>"><!--
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
						<input type="text" name="surname" id="surname" value="<?php echo $this->auth_user->getSurname(); ?>"><!--
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
						<input type="text" name="email" id="email" autocomplete="off" value="<?php echo $this->auth_user->getEmail(); ?>"><!--
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
						<input type="password" name="password" id="password" autocomplete="off" value=""><!--
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

					<input type="submit" class="btn btn-primary btn-large" name="update" value="Update">

				</form>

			</div><!-- card -->

		</div><!-- gs-col -->

	</div><!-- gs -->


<?php include_once("app/views/partials/footer.php"); ?>

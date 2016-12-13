	</div><!-- .container -->

	<footer>


		<div class="container">

			<div class="gs">

				<div class="gs-col gs-medium8 gs-medium2-before gs-small12">

					<div class="gs">

						<div class="gs-col gs-medium4 gs-small12">

							<h3>About</h3>

							<p>
								Li Europan lingues es membres del sam familie. Lor separat existentie es un myth.
								Por scientie, musica, sport etc, litot Europa usa li sam vocabular.

								Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.
								Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores.
							</p>

						</div><!-- gs-col -->

						<div class="gs-col gs-medium4 gs-small12">

								<h3>Latest Venues</h3>

								<ul class="list-reset">
									<?php foreach ($this->latest_venues as $latest_venue) { ?>
										<li><a href="venues/<?php echo $latest_venue["venue_id"]; ?>"><?php echo $latest_venue["name"]; ?></a></li>
									<?php } ?>
								</ul>

						</div><!-- gs-col -->

						<div class="gs-col gs-medium4 gs-small12 footer-social">

							<h3>Social</h3>

							<ul class="list-reset">
								<li><a href="http://facebook.com"><span class="icon-facebook"></span> Facebook</a></li>
								<li><a href="http://twitter.com"><span class="icon-twitter"></span> Twitter</a></li>
								<li><a href="http://instagram.com"><span class="icon-instagram"></span> Instagram</a></li>
								<li><a href="http://plus.google.com"><span class="icon-google-plus"></span> Google Plus</a></li>
							</ul>

						</div><!-- gs-col -->

					</div><!-- gs -->

				</div><!-- gs-col -->

			</div><!-- gs -->

			<p class="footer-disclaimer">Copyright &copy; 2016 - Michael Griffin</p>

		</div><!-- container -->

	</footer>


	<script type="text/javascript" src="Assets/script.js"></script>
	<?php if ($this->scripts) {
		foreach($this->scripts as $script) { ?>
			<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php }
 	} ?>
</body>
</html>

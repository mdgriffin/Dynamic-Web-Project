	</div><!-- .container -->
	<script type="text/javascript" src="Assets/script.js"></script>
	<?php if ($this->scripts) {
		foreach($this->scripts as $script) { ?>
			<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php }
 	} ?>
</body>
</html>

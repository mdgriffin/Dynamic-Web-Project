<?php
include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Venue Images for <?php echo $this->venue->getName(); ?></h1>

<form action="admin/venues/<?php echo $this->venue_id; ?>/images" method="post" enctype="multipart/form-data">
  <input type="file" name="image_file" accept="image/*">
  <input type="submit">
</form>


<?php include_once("app/views/partials/footer.php"); ?>

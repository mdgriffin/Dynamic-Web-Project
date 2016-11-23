<?php
include_once("app/views/partials/header.php");
include_once("app/views/partials/admin-nav.php");
?>

<h1>Admin: Manage Venue Images for <?php echo $this->venue->getName(); ?></h1>

<form action="admin/venues/<?php echo $this->venue_id; ?>/images" method="post" enctype="multipart/form-data">

  <fieldset>
    <label for="title">Image Title</label>
    <input type="text" name="title" value="<?php $this->image->getTitle(); ?>">
    <?php
    if (isset($this->errors["title"]) && $this->errors) {
      foreach ($this->errors["title"] as $error) {
    ?>
        <p class="form-error"><?php echo $error; ?></p>
    <?php
      }
    }
    ?>
  </fieldset>

  <fieldset>
    <label for="image_file">Upload Image</label>
    <input type="file" name="image_file" accept="image/*">
  </fieldset>

  <input type="submit">

</form>


<?php include_once("app/views/partials/footer.php"); ?>

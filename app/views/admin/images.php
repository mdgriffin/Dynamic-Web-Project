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

<table>
  <thead>
    <tr>
      <th>Image ID</td>
      <th>Image</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($this->venue_images as $venue_image)  { ?>
      <tr>
          <td><?php echo $venue_image["image_id"]; ?></td>
          <td>
            <a href="<?php echo $venue_image["source"]; ?>">
              <img src="<?php echo ImageResizer::getImage($venue_image['source'], 'thumbnail'); ?>" alt="<?php echo $venue_image["title"]; ?>" title="<?php echo $venue_image["title"]; ?>">
            <a/>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<?php include_once("app/views/partials/footer.php"); ?>

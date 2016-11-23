<?php

class ImageResizer {

  private $target_dir = "Assets/temp"

  private array $sizes = array(
    "banner" => array(900, 450),
    "large_square" => array(900, 900),
    "medium_square" => array(600, 600),
    "thumbnail" => array(150, 150)
  );

  public static getImage ($imageSrc, $sizeKey) {
    // check if the image has already been generated
    // if not create the new image
    // return image
  }
}


?>

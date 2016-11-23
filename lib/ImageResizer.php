<?php

class ImageResizer {

	private static $target_dir = "Assets/temp_images/";
	private static $sizes = array(
		"banner" => array(900, 450),
		"large_square" => array(900, 900),
		"medium_square" => array(600, 600),
		"thumbnail" => array(150, 150)
	);

	public static function getImage ($imageSrc, $sizeKey) {

		$imageSrc_parts = pathinfo($imageSrc);
		$imageSrcName = $imageSrc_parts["filename"];
		$imageSrcExt = $imageSrc_parts["extension"];

		$target_file_src =  self::$target_dir . $imageSrcName . "_" . $sizeKey . "." . $imageSrcExt;

		// check if the image has already been generated
		if (file_exists($target_file_src)) {
			return $target_file_src;
		// if not create the new image
		} else {
			$dest_image = imagecreatetruecolor(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1]);
			$src_image = imagecreatefromjpeg($imageSrc);
			list($src_width, $src_height) = getimagesize($imageSrc);
			imagecopyresampled($dest_image, $src_image, 0, 0, 0, 0, self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);

			// !!! check the file type and call the correct method
			imagejpeg($dest_image, $target_file_src);
			imagedestroy($dest_image);

			// return the url of the newly generated image
			return $target_file_src;
		}

	}

}

?>

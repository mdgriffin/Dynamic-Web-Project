<?php

class Image {

	private static $target_dir = "Assets/temp_images/";
	private static $sizes = array(
		"banner" => array(900, 450),
		"large_square" => array(900, 900),
		"medium_square" => array(600, 600),
		"thumbnail" => array(150, 150)
	);

	public static function getSize($imageSrc, $sizeKey) {

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
			list($srcX, $srcY) = self::getSourceXY(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);

			imagecopyresampled($dest_image, $src_image, 0, 0, $srcX, $srcY, self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);

			if ($imageSrcExt == "png") {
				imagepng($dest_image, $target_file_src);
			} else if ($imageSrcExt == "gif") {
				imagegif($dest_image, $target_file_src);
			} else {
				imagejpeg($dest_image, $target_file_src);
			}

			imagedestroy($dest_image);

			// return the url of the newly generated image
			return $target_file_src;
		}

	}

	private static function getSourceXY($destWidth, $destHeight, $srcWidth, $srcHeight) {
		// todo Figure out how the source image into the destination image in the most efficient fashion
		// finding the x and y co-ordinates  of the src image
		$x = 0;
		$y = 0;

		return array($x, $y);
	}

}

?>

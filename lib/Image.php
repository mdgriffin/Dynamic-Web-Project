<?php

class Image {

	private static $target_dir = "Assets/temp_images/";
	private static $sizes = array(
		"banner" => array(900, 450),
		"small_banner" => array(450, 225),
		"large_square" => array(900, 900),
		"medium_square" => array(600, 600),
		"thumbnail" => array(150, 150)
	);

	public static function getSize($imageSrc, $sizeKey) {

		$imageSrc_parts = pathinfo($imageSrc);
		$imageSrcName = $imageSrc_parts["filename"];
		$imageSrcExt = $imageSrc_parts["extension"];

		$target_file_src =  self::$target_dir . $imageSrcName . "_" . $sizeKey . "2." . $imageSrcExt;

		// check if the image has already been generated
		if (file_exists($target_file_src)) {
			return $target_file_src;
		// if not create the new image
		} else {
			$dest_image = imagecreatetruecolor(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1]);
			$src_image = imagecreatefromjpeg($imageSrc);

			list($src_width, $src_height) = getimagesize($imageSrc);

			//list($srcX, $srcY) = self::getSourceXY(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);
			//list($normalizedSrcWidth, $normalizedSrcHeight) = self::getNormalizedSize(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);

			list($normalizedSrcWidth, $normalizedSrcHeight,$srcX, $srcY) = self::getBestFit($src_width, $src_height, self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1]);

			imagecopyresampled($dest_image, $src_image, 0, 0, $srcX, $srcY, self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $normalizedSrcWidth, $normalizedSrcHeight);

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

	private static function getBestFit ($src_width, $src_height, $dest_width, $dest_height) {
		$width_diff = abs($src_width - $dest_width);
		$height_diff = abs($src_height - $dest_height);

		if ($width_diff > $height_diff) {
			// scale width
			$scale_factor = $src_width / $dest_width;
			$resized_width = $src_width;
			$resized_height = $dest_height * $scale_factor;
		} else {
			// scale height
			$scale_factor = $src_height / $dest_height;
			$resized_width = $dest_width * $scale_factor;
			$resized_height = $src_height;
		}

		if ($resized_width > $src_width || $resized_height > $src_height) {
			return self::getBestFit($src_width, $src_height, $resized_width, $resized_height);
		} else {
			$srcX = ($src_width - $resized_width) / 2;
			$srcY = ($src_height - $resized_height) / 2;

			return array($resized_width, $resized_height, $srcX, $srcY);
		}
	}

}

?>

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

		$target_file_src =  self::$target_dir . $imageSrcName . "_" . $sizeKey . "2." . $imageSrcExt;

		// check if the image has already been generated
		if (file_exists($target_file_src)) {
			return $target_file_src;
		// if not create the new image
		} else {
			$dest_image = imagecreatetruecolor(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1]);
			$src_image = imagecreatefromjpeg($imageSrc);

			list($src_width, $src_height) = getimagesize($imageSrc);
			list($srcX, $srcY) = self::getSourceXY(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);
			list($normalizedSrcWidth, $normalizedSrcHeight) = self::getNormalizedSize(self::$sizes[$sizeKey][0], self::$sizes[$sizeKey][1], $src_width, $src_height);

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

	private static function getNormalizedSize ($destWidth, $destHeight, $srcWidth, $srcHeight) {

			// if width is closer
			if (abs($destWidth - $srcWidth) < abs($destHeight - $srcHeight)) {
				$srcHeight = $destHeight * ($srcWidth / $destWidth);
			// else height is closer
		} else {
				$srcWidth = $destWidth * ($srcHeight / $destHeight);
		}

		return array($srcWidth, $srcHeight);
	}

	private static function getSourceXY($destWidth, $destHeight, $srcWidth, $srcHeight) {
		list($normalizedSrcWidth, $normalizedSrcHeight) = self::getNormalizedSize($destWidth, $destHeight, $srcWidth, $srcHeight);

		if ($normalizedSrcWidth != $srcWidth) {
			$x = abs($srcWidth - $normalizedSrcWidth) / 2;
			$y = 0;
		} else {
			$x = 0;
			$y = abs($srcHeight - $normalizedSrcHeight) / 2;
		}

		return array($x, $y);
	}

}

?>

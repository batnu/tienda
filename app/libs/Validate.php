<?php
/**
 * Clase para validaciones
 */
class Validate
{
	public static function number($string)
	{
		$search = [' ', '€', '$', ','];
		$replace = ['', '', '', '.'];
		$number = str_replace($search, $replace, $string);
		return $number;
	}
	public static function date($string)
	{
		$date = explode('-', $string);
		if (count($date) == 1) {
			return false;
		}
		return checkdate($date[1], $date[2], $date[0]);
	}
	public static function dateDif($string)
	{
		$now = new DateTime();
		$date = new DateTime($string);
		return $date > $now;
	}
	public static function file($string)
	{
		$search = [' ', '*', '!', '@', '?', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', '¿', '¡', 'ñ', 'Ñ'];
		$replace = ['-', '', '', '', '', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', '', '', 'n', 'N'];
		$file = str_replace($search, $replace, $string);
		return $file;
	}
	public static function resizeImage($image, $newWidth)
	{
		$file = 'img/' . $image;
		$info = getimagesize($file);
		$width = $info[0]; //Ancho
		$height = $info[1]; //Alto
		$type = $info['mime'];
		$factor = $newWidth / $width;
		$newHeight = $factor * $height;
		if($info[2] == IMAGETYPE_JPEG){
			$image = imagecreatefromjpeg($file);	
		}elseif ($info[2] == IMAGETYPE_PNG) {
			$image = imagecreatefrompng($file);
		}elseif ($info[2] == IMAGETYPE_GIF) {
			$image = imagecreatefromgif($file);
		}
		$canvas = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($canvas, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagejpeg($canvas, $file, 80);
	}
	public static function imageFile($file)
	{
		$info = getimagesize($file);
		$imageType = $info[2];
		return (bool) (in_array($imageType, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF]));
	}
	public static function text($string)
	{
		$search = ['^', 'delete', 'drop', 'truncate', 'exec', 'system'];
		$replace = ['-', 'dele*te', 'dr*op', 'trun*cate', 'ex*ec', 'sys*tem'];
		$string = str_replace($search, $replace, $string);
		$string = addslashes(htmlentities($string));
		return $string;
	}
}

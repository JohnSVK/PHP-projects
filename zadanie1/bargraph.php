<?php
	$paddingImage = 50;
	$fontFile = './ARIAL.TTF';
	
	$labelX = ['A', 'B', 'C', 'D', 'E', 'FX', 'FN'];
	$labelY = 'pocet studentov';
	$labelTitles = ['sk. rok 2012/13', 'sk. rok 2013/14', 'sk. rok 2014/15'];
	
	$width = 1000 + $paddingImage*2;
	$height = 200 + $paddingImage*2;
	
	$image 	= imagecreatetruecolor($width, $height);
	
	$columnColor = imagecolorallocate($image, 0xb8, 0xf6, 0x00);
	$gray_lite 	= imagecolorallocate($image, 0xee, 0xee, 0xee);
	$gray_dark 	= imagecolorallocate($image, 0x7f, 0x7f, 0x7f);
	$white 		= imagecolorallocate($image, 0xff, 0xff, 0xff);
	$black 		= imagecolorallocate($image, 0x00, 0x00, 0x00);
	
	imagefilledrectangle($image, 0, 0, $width, $height, $white);
	
	$paddingBars = 5;
	$paddingGraphs = 100;
	
	$data = [[20, 11, 13, 7, 5, 0, 1], [20, 19, 6, 3, 1, 0, 0], [9, 19, 22, 0, 0, 0, 3]];
	
	$graphNo = 0;
	
	$width = 1000;
	$height = 200;
	
	foreach($data as $values) {
		$columns = count($values);
		$max_value = max($values);
		$column_width = (($width / 3) - $paddingGraphs) / $columns;
		
		$graphWidth = $graphNo * ($width / 3);
		$graphNo++;
		
		for($i=0;$i<$columns;$i++) {
			$column_height = (($height ) / 100) * (($values[$i] / $max_value) * 100);
			
			$x1 = $i * $column_width + $graphWidth + $paddingImage;
			$y1 = $height - $column_height + $paddingImage;
			$x2 = (($i + 1) * $column_width) - $paddingBars + $graphWidth + $paddingImage;
			$y2 = $height + $paddingImage;
			
			imagefilledrectangle($image, $x1, $y1, $x2, $y2, $columnColor);
			
			imageline($image, $x1, $y1, $x1, $y2, $gray_lite); 
			imageline($image, $x1, $y2, $x2, $y2, $gray_lite); 
			imageline($image, $x2, $y1, $x2, $y2, $gray_dark);
			
			imagefttext($image, 12, 0, $x1 + $column_width / $columns, $y2 + 20, $black, $fontFile, $labelX[$i]);
			
			if($values[$i] > 1) {
				imagefttext($image, 10, 0, $x1 + $column_width / $columns, $y1 + 15, $black, $fontFile, $values[$i]);
			} else if ($values[$i] == 1){
				imagefttext($image, 10, 0, $x1 + $column_width / $columns, $y1, $black, $fontFile, $values[$i]);
			} else {
				imagefttext($image, 10, 0, $x1 + $column_width / $columns, $y1, $black, $fontFile, $values[$i]);
			}
		}
		
		//imageline($image, $graphWidth + $paddingImage, $height - $column_height + $paddingImage,$x1,$y2,$gray_lite);
		//imageline($image, $graphWidth + $paddingImage, $height - $column_height + $paddingImage,$x1,$y2,$gray_lite);
		imagefttext($image, 12, 90, $graphWidth + $paddingImage - 10, $height, $black, $fontFile, $labelY);
		imagefttext($image, 12, 0, $graphWidth + ($width / 3) / 2 - $paddingImage, $paddingImage - 15, $black, $fontFile, $labelTitles[$graphNo - 1]);
		
	}
	header("Content-type: image/png");
	
	error_reporting(E_ALL); ini_set("display_errors", 1);
	
	// create and display image
	$saveImage = "/home/kanas/public_html/zadanie01/images/bar.png";
	
	// display image
	imagepng($image);
	// create new image in /images
	imagepng($image, $saveImage, 9);
	//chmod("$save", 0777);
	
	// create thumbnail
	$saveThumb = "/home/kanas/public_html/zadanie01/thumbs/bar_thumb.png";
	
	$thumbWidth = 200;
	$newWidth = $thumbWidth;
	$newHeight = floor($height * ($thumbWidth / $width));
	
	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	
	imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	
	imagepng($thumb, $saveThumb);
	
	
	echo "OK";
?>
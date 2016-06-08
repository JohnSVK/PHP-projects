<?php
	$paddingImage = 50;
	$fontFile = './ARIAL.TTF';
	
	$labelX = ['A', 'B', 'C', 'D', 'E', 'FX', 'FN'];
	$labelY = 'pocet studentov';
	$labelTitles = ['sk. rok 2012/13', 'sk. rok 2013/14', 'sk. rok 2014/15'];
	
	$width = 1200 + $paddingImage*2;
	$height = 200 + $paddingImage*2;
	
	$image 	= imagecreatetruecolor($width, $height);
	
	$green		= imagecolorallocate($image, 0xb8, 0xf6, 0x00);
	$gray_lite 	= imagecolorallocate($image, 0x2e, 0xee, 0xee);
	$gray_dark 	= imagecolorallocate($image, 0x7f, 0x7f, 0x7f);
	$navy     	= imagecolorallocate($image, 0x00, 0x00, 0x80);
	$darknavy 	= imagecolorallocate($image, 0x00, 0xa0, 0x50);
	$red      	= imagecolorallocate($image, 0xFF, 0x00, 0x00);
	$darkred  	= imagecolorallocate($image, 0x90, 0x00, 0xc0);
	
	$white 		= imagecolorallocate($image, 0xff, 0xff, 0xff);
	$black 		= imagecolorallocate($image, 0x00, 0x00, 0x00);
	
	$colors  = [$green, $gray_dark, $navy, $darknavy, $red, $darkred, $black];
	
	imagefilledrectangle($image, 0, 0, $width, $height, $white);

	$paddingGraphs = 100;
	
	$data = [[20, 11, 13, 7, 5, 0, 1], [20, 19, 6, 3, 1, 0, 0], [9, 19, 22, 0, 0, 0, 3]];
	
	$graphNo = 0;
	
	$width = 1000;
	$height -= $paddingImage*2;
	
	foreach($data as $values) {
		$arcs = count($values);
		
		$graphWidth = $graphNo * ($width / 3 + $paddingImage);
		$graphNo++;
		
		$startAngle = 0;
		for($i=0;$i<$arcs;$i++) {
			$arcWidth = round((360 * $values[$i]) / array_sum($values));
			
			$arcPercentageX = $paddingImage + 50 * $i + $graphWidth;
			$arcPercentageY = $height + $paddingImage + 20;
			imagefttext($image, 10, 0, $arcPercentageX , $arcPercentageY, $black, $fontFile, round(($values[$i] / array_sum($values)) * 100) . '% ' . $labelX[$i]);
			imagefilledrectangle($image, $arcPercentageX - 10, $arcPercentageY - 10, $arcPercentageX - 5, $arcPercentageY, $colors[$i]);
			
			if($arcWidth != 0)
				imagefilledarc($image, $paddingImage + $graphWidth + ($width / 3) / 2 , $paddingImage + $height / 2, $width / 3 - $paddingImage, $height, $startAngle, $startAngle + $arcWidth, $colors[$i], IMG_ARC_PIE);
			
			$startAngle += $arcWidth;
		}

		imagefttext($image, 12, 90, $graphWidth + $paddingImage - 10, $height, $black, $fontFile, $labelY);
		imagefttext($image, 12, 0, $graphWidth + ($width / 3) / 2 - $paddingImage, $paddingImage - 15, $black, $fontFile, $labelTitles[$graphNo - 1]);
		
	}
	
	header("Content-type: image/png");
	
	error_reporting(E_ALL); ini_set("display_errors", 1);
	
	$saveImage = "/home/kanas/public_html/zadanie01/images/pie.png";
	
	// display image
	imagepng($image);
	// create new image in /images
	imagepng($image, $saveImage, 9);
	//chmod("$save", 0777);
	
	// create thumbnail
	$saveThumb = "/home/kanas/public_html/zadanie01/thumbs/pie_thumb.png";
	
	$thumbWidth = 200;
	$newWidth = $thumbWidth;
	$newHeight = floor($height * ($thumbWidth / $width));
	
	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	
	imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	
	imagepng($thumb, $saveThumb);
	
	echo "OK";
?>
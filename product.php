<h1> Image crop to square php GD LIBRARY </h1>

<?php

$filename = "aaron.jpg";
$newFilename = 'newProduct.jpg';

$imageSize = getimagesize($filename);
$currentWidth = $imageSize[0];
$currentHeight = $imageSize[1];

$left = 0; //crop left margin
$top = 0; // crop top margin

$cropWidth = 300;
$cropHeight = 300;

$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
$currentImage = imagecreatefromjpeg($filename);
imagecopy($canvas,$currentImage,0,0,$left,$top,$currentWidth,$currentHeight);
imagejpeg($canvas,$newFilename,100);
echo "Image cropped successfully";
exit;

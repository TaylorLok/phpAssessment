<!DOCTYPE html>
<html>
<body>
<?php
class Assessment{
	
	 	public $staffMember = 250;
    	public $productImage= 300;
    	public $original_image = 0;

     public function __construct($staffMember, $productImage)
    {
        $this->staffMember = $staffMember;
        $this->productImage = $productImage;
    }


	public function resize($file,$max_res)
	{
		if(file_exists($file))
		{
			/////jpg resizefunction start here /////
			$original_image = imagecreatefromjpg($file);

			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			$ratio = $max_res / $original_width;
			$new_width = $max_res;
			$new_height = $original_height * $ratio;

			if($new_height > $max_res)
			{
				$ratio = $max_res /$original_height;
				$new_height = $max_res;
				$new_width = $original_width*$ratio;
			}

			if($original_image)
			{
				$new_image = imagecreatetruecolor($new_width,$new_height);
				imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

				imagejpg($new_image,$file,90); //render out
			}
		}
	}

	public function crop($file,$max_res)
	{
		if(file_exists($file))
		{
			/////jpg resizefunction start here /////
			$original_image = imagecreatefromjpg($file);

			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			//try max
			if ($original_height > $original_width)
			{
				$ratio = $max_res / $original_width;
				$new_width = $max_res;
				$new_height = $original_height * $ratio;

				$diff = $new_height - $new_width;

				$x = 0;
				$y = round($diff / 2); // to bring value to the nearest value close
			}
			else
			{
				$ratio = $max_res / $original_height;
				$new_height = $max_res;
				$new_width = $original_width*$ratio;

				$diff = $new_width - $new_height; // trying to get exceeding number in pixels

				$x = round($diff / 2); //move to the center of the image
				$y = 0;
			}

			if($original_image)
			{
				$new_image = imagecreatetruecolor($new_width,$new_height);
				imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

				$new_crop_image = imagecreatetruecolor($max_res, $max_res);
				imagecopyresampled($new_crop_image, $new_image, 0, 0, $x, $y, $max_res, $max_res, $max_res, $max_res);


				imagejpg($new_crop_image,$file,90); //render out
			}
		}
	}

	// if($_SERVER['REQUEST_METHOD']=="POST")
	// {
	// 	if(isset($_FILES['image']) && $_FILES['image']['type'] == 'image/jpg')
	// 	{
	// 		move_uploaded_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);

	// 		$file = $_FILES['image']['name'];

	// 		//resize
	// 		resize($file,"300");

	// 		//crop
	// 		crop($file,"300");

	// 		echo "<img src='$file' style=''/>";
	// 	}
	// 	else
	// 	{
	// 		echo "file not supported";
	// 	}
	// }	

} 

?>
</body>
</html>


<form method="post" enctype="multipart/form-data">

	<input type="file" name="image"/><br/>
	<input type="submit" value="post" />

</form>
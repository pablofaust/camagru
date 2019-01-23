<?php foreach ($images as $image):

		$img = new Image ($image);
		$url = $img->getPath();
		echo "<img src=\"$url\"/>";

endforeach; ?>



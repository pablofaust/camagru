<?php foreach ($images as $image):

		$img = new Image ($image);
		$url = $img->getPath();
		echo "<div class='gallery-img' style='background-image:url(\"$url\");'></div>";

endforeach; ?>



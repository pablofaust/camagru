<?php 

	class Image {

		private $path;

		public function __construct($image) {
			$this->path = 'localhost:8888/public/img/' . $image->title;
		}

		public function getPath() {

			return $this->path;
		}
	}
?>
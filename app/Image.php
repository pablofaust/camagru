<?php 

	class Image {

		private $path;

		public function __construct($image) {
			$this->path = '/public/img/' . $image->title;
		}

		public function getPath() {

			return $this->path;
		}
	}
?>
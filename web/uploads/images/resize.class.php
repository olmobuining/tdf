<?php 
$resize = new resizeImage();
$result = $resize->resizeee();
//var_dump($result);
class resizeImage {
	var $image;
	var $image_type;
	var $prefixFolder = '/var/www/testing/olmo/test/images/';
	
 	public function resizeToAll($filename, $saveName, $title, $text, $user_id) {
		while(is_dir($saveName)) {
			$saveName = md5(time());
		}
		$this->resizeToMaxSize($filename, $saveName, 'thumb');
		$this->resizeToMaxSize($filename, $saveName, 'small');
		$this->resizeToMaxSize($filename, $saveName, 'medium');
		$this->resizeToMaxSize($filename, $saveName);
		$this->resizeToMaxSize($filename, $saveName, 'original');
		unlink($this->prefixFolder.$filename);
		$this->saveInDatabase($saveName, $title, $text, $filename, $user_id);
		
	}
	
	public function resizeee() {
		foreach(glob('*/original/*') as $folder) {
			
			$split = explode('/', $folder);
			echo $split[0];
			$this->resizeToMaxSize($folder, $split[0], 'small');
			$this->resizeToMaxSize($folder, $split[0], 'medium');
			echo 'done: '. $split[3]."<br>";
		}
		/*
		if($dh = opendir($this->prefixFolder)) {
			while(($file = readdir($dh)) !== false) {
				if($file !== '..' || $file !== '.') {
					echo "filename: $file : filetype: " . filetype($this->prefixFolder . $file) . "<br>"; 
				}
			}
		}*/
	}
	
	protected function resizeToMaxSize($filename, $saveName, $filesize='large') {
		if ($filesize == 'thumb') {
			$folder = $filesize;
			$maxWidth = 100;
			$maxHeight = 100;	
		} elseif ($filesize == 'small') {
			$folder = $filesize;
			$maxWidth = 200;
			$maxHeight = 120;	
		} elseif ($filesize == 'medium') {
			$folder = $filesize;
			$maxWidth = 400;
			$maxHeight = 240;	
		} elseif ($filesize == 'large') {
			$folder = $filesize;
			$maxWidth = 700;
			$maxHeight = 420;	
		} elseif ($filesize == 'original') {
			$folder = $filesize;
			$maxWidth = 1500;
			$maxHeight = 900;	
		}
		$this->load($filename);
		$height = $this->getHeight();
		$width = $this->getWidth();
		if($width > $height) {
			if($width > $maxWidth) {
				$this->resizeToWidth($maxWidth);
			}
		} elseif ($width < $height) {
			if($height > $maxHeight) {
				$this->resizeToHeight($maxHeight);
			}
		} else {
			if($height > $maxHeight) {
				$this->resizeToHeight($maxHeight);
			}
		}
		if($this->getWidth() > $maxWidth) {
			if($this->getWidth() > $maxWidth) {
				$this->resizeToWidth($maxWidth);
			}
		} elseif ($this->getHeight() >$maxHeight) {
			if($this->getHeight() > $maxHeight) {
				$this->resizeToHeight($maxHeight);
			}
		}
		if( $this->image_type == IMAGETYPE_JPEG ) {
			$extention = '.jpg';
	  } elseif( $this->image_type == IMAGETYPE_GIF ) {
	  		$extention = '.gif';
	  } elseif( $this->image_type == IMAGETYPE_PNG ) {
			$extention = '.png';
	  }
	//	mkdir($this->prefixFolder.$saveName.DIRECTORY_SEPARATOR.$folder, 0775, true);
		$split = explode('/', $filename);
		
		$this->save($this->prefixFolder.$saveName.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$split[2]);
		return $saveName;
	}
	
	public function saveInDatabase($folder, $title, $description, $src, $user_id) {
		$newImage = new Image();
		$newImage->folder = $folder;
		$newImage->title = $title;
		$newImage->text = $description;
		$newImage->src = $src;
		$newImage->user_id = $user_id;
		$newImage->created_at = time();
		$newImage->save();
	}
	
	protected function load($filename) {
		$filename = $this->prefixFolder.$filename;
	  $image_info = getimagesize($filename);
	  $this->image_type = $image_info[2];
	  if( $this->image_type == IMAGETYPE_JPEG ) {
	
		 $this->image = imagecreatefromjpeg($filename);
	  } elseif( $this->image_type == IMAGETYPE_GIF ) {
	
		 $this->image = imagecreatefromgif($filename);
	  } elseif( $this->image_type == IMAGETYPE_PNG ) {
	
		 $this->image = imagecreatefrompng($filename);
	  }
	}
	
	protected function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
	
	  if( $image_type == IMAGETYPE_JPEG ) {
		 imagejpeg($this->image,$filename,$compression);
	  } elseif( $image_type == IMAGETYPE_GIF ) {
	
		 imagegif($this->image,$filename);
	  } elseif( $image_type == IMAGETYPE_PNG ) {
	
		 imagepng($this->image,$filename);
	  }
	  if( $permissions != null) {
	
		 chmod($filename,$permissions);
	  }
	}
	
	protected function output($image_type=IMAGETYPE_JPEG) {
		$filename = $this->prefixFolder.$filename;
	
		if( $image_type == IMAGETYPE_JPEG ) {
			 imagejpeg($this->image);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			 imagegif($this->image);
		} elseif( $image_type == IMAGETYPE_PNG ) {
			 imagepng($this->image);
		}
	}
	
	protected function getWidth() {
	  return imagesx($this->image);
	}
	
	protected function getHeight() {
	
	  return imagesy($this->image);
	}
	
	protected function resizeToHeight($height) {
	
	  $ratio = $height / $this->getHeight();
	  $width = $this->getWidth() * $ratio;
	  $this->resize($width,$height);
	}
	
	protected function resizeToWidth($width) {
	  $ratio = $width / $this->getWidth();
	  $height = $this->getheight() * $ratio;
	  $this->resize($width,$height);
	}
	
	protected function scale($scale) {
	  $width = $this->getWidth() * $scale/100;
	  $height = $this->getheight() * $scale/100;
	  $this->resize($width,$height);
	}
	
	protected function resize($width,$height) {
	  $new_image = imagecreatetruecolor($width, $height);
	  imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
	  $this->image = $new_image;
	}      
	
	
}


?>
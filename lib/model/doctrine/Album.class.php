<?php

/**
 * Album
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    tdf
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Album extends BaseAlbum
{
	public function getNextImage($image) {
		$imagesIds = array();
		$images = array();
		foreach($this->Images as $img) {
			array_push($imagesIds, $img->id);
			array_push($images, $img);
		}
		sort($imagesIds);
		sort($images);
		$current_index = array_search($image->id, $imagesIds);
		$next = $current_index + 1;
		if ($next < count($images)):
			return $images[$next];
		endif;

		
	}
}

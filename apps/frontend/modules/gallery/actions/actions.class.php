<?php

/**
 * gallery actions.
 *
 * @package    tdf
 * @subpackage gallery
 * @author     Olmo Buining
 */
class galleryActions extends myActions
{
  
  /**
   *         All Albums page
   *   With first image
   *
   */
  public function executeIndex(sfWebRequest $request)
  {
    $allAlbums = Doctrine::getTable('Album')->getAll();
	$albums = array();
	foreach($allAlbums as $album) {
		if( count($album->Images) > 0) {
			array_push($albums, $album);	
		}
	}
	$this->albums = $albums;
	$this->forward404unless($this->albums);
	// SET META
	$this->getResponse()->addMeta('description', 'Alle albums met screenshots, plaatjes van onze guild en guild wars 2. ');
	$this->setTitle(' Albums ');
  }
  
  /**
   *         Single Album page
   *   With all images.
   *
   */
  public function executeAlbum(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
	$this->album = Doctrine::getTable('Album')->findOneBySlug($slug);
	$this->forward404unless($this->album);
	if (count($this->album->Images) == 0) {
		$this->redirect('/gallery');	
	}
	// SET META
	$this->getResponse()->addMeta('description', 'Album: '.$this->album->name.'.');
	$this->setTitle('Album: '.$this->album->name);
	
	
	$images = array();
	foreach ($this->album->Images as $image) {
		array_push($images, $image);	
	}
	sort($images);
	$this->images = $images;
  }
  
  /**
   *         Single image page
   *
   *
   */
  public function executeImage(sfWebRequest $request)
  {
    $type = $request->getParameter('type');
	$typeSlug = $request->getParameter('type_slug');
	$imageSlug = $request->getParameter('image_slug');
	$this->image = Doctrine::getTable('Image')->findOneBySlug($imageSlug);
	$this->forward404unless($this->image);
	$this->tAlbum = false;
	$this->tRandom = false;
	if ($type == 'album') {
		$this->thisAlbum = Doctrine::getTable('Album')->findOneBySlug($typeSlug);
		$this->nextImage = $this->thisAlbum->getNextImage($this->image);
		$this->tAlbum = true;
		$this->albumName = $typeSlug;
	}
	$login = new LoginClass();
	$this->isLoggedIn = $login->check();
	if ($this->isLoggedIn) {
		$this->userLogged = $login->getLoggedUser();
	}
	// SET META
	$this->getResponse()->addMeta('description', 'Plaatje: '.$this->image->title.'. in Album:'.$this->thisAlbum->name);
	$this->setTitle($this->image->title);
	
	sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
	// Set Social media slot
	$this->getResponse()->setSlot('socialmediaHeader', 
	'
	<meta property="og:title" content="'.$this->image->title.'" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://guild-tdf.nl/'.url_for('image', array('type' => 'album', 'type_slug' => $this->thisAlbum->slug, 'image_slug' => $this->image->slug)).'" />
	<meta property="og:image" content="http://guild-tdf.nl/uploads/images/'. $this->image->folder.'/large/'. $this->image->src.'" />
	<meta property="og:site_name" content="The Dutch Fellowship" />
	<meta property="fb:admins" content="718198926" />
	'
	);
  }
}

<?php

/**
 * tag actions.
 *
 * @package    tdf
 * @subpackage tag
 * @author     Olmo Buining
 */
class tagActions extends myActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
	$this->tag = Doctrine::getTable('Tag')->findOneBySlug($slug);
	$this->relatedBlogs = $this->tag->getBlogs();
	$this->relatedImages = $this->tag->getImages();
	// SET META
	$this->getResponse()->addMeta('description', 'Vind alle blogs of plaatjes gerelateerd met tag:'.$this->tag->name);
	$this->setTitle(' Tag: '.$this->tag->name);
  }
}

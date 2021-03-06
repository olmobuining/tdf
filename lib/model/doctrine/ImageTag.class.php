<?php

/**
 * imageTag
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    tdf
 * @subpackage model
 */
class imageTag extends BaseimageTag
{
	
	public function checkLink() {
		$q = Doctrine_Query::create()
			->from('imageTag p')
			->where('p.image_id = ?', $this->image_id)
			->andWhere('p.tag_id = ?', $this->tag_id);
		 
		$result = $q->execute();
		if(count($result) > 0) {
			return true;	
		} else {
			return false;	
		}
		
	}
}

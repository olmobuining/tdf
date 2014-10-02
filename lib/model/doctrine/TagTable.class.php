<?php

/**
 * TagTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TagTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TagTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Tag');
    }
	public function getAll($limit = 0) {
		$q = Doctrine_Query::create()
			->from('Tag t')
			->orderBy('RAND()')
			->limit($limit);
		 
		return $q->execute();	
	}
}
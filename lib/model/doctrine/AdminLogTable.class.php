<?php

/**
 * AdminLogTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AdminLogTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AdminLogTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AdminLog');
    }
	
	public function getLast($limit=0) {
		$q = Doctrine_Query::create()
			->from('AdminLog al')
			->orderBy('al.created_at DESC')
			->limit($limit);
		 
		return $q->execute();		
	}
}
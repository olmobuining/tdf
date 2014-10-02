<?php

/**
 * UserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UserTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UserTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }
	 
	public function getAll() {
		$q = Doctrine_Query::create()
			->from('User u');
		 
		return $q->execute();	
	}
	
	public function getLeaders() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id >= ?', 2)
			->andWhere('u.rank_id <= ?', 3);
		 
		return $q->execute();	
	}
	
	public function getVeterans() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 4);
		 
		return $q->execute();	
	}
	
	public function getPvxs() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 7);
		 
		return $q->execute();	
	}
	
	public function getPvps() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 6);
		 
		return $q->execute();	
	}
	
	public function getPves() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 5);
		 
		return $q->execute();	
	}
	
	public function getWvws() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 9);
		 
		return $q->execute();	
	}
	
	public function getInterns() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.rank_id = ?', 8);
		 
		return $q->execute();	
	}
	
	public function getInactiveUsers() {
		$q = Doctrine_Query::create()
			->from('User u')
			->where('u.permission_id = ?', 1);
		 
		return $q->execute();	
	}
	
	public function getUsersToPromoteFromIntern() {
		$q = Doctrine_Query::create()
			->from('User u')
			->innerJoin('u.Extras e')
			->where('u.permission_id = ?', 2)
			->andWhere('e.extra_type_id = 4')
			->andWhere('e.created_at < ?', time()-(60*60*24*30));
		 
		return $q->execute();	
	}
	
	
	public function getLoginsFromTheLast24Hours() {
		$q = Doctrine_Query::create()
			->from('Extra e')
			->innerJoin('e.User u')
			->innerJoin('e.ExtraType et')
			->where('et.code = ?', 'LAST-ONL')
			->andWhere('e.value > ?', time()-(60*60*24))
			->groupBy('u.id')
			->orderBy('e.value DESC');
		 
		return $q->execute();
	}
	
}
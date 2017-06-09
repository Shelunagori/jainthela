<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\ORM\Table;

class UsersTable extends Table
{
	public function initialize(array $config)
    {
		
	}
	public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required');
    }
	public function findAuth(\Cake\ORM\Query $query, array $options)
	{
		$query
			->where(['Users.status' => 'Active']);

		return $query;
	}
	
}
?>
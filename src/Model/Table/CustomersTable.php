<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\FranchisesTable|\Cake\ORM\Association\BelongsTo $Franchises
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomersTable extends Table
{

	 /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		$this->belongsTo('ReferralDetails');
		$this->hasMany('JainCashPoints', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
		$this->hasMany('Wallets', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
		$this->hasMany('Orders', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
		$this->hasMany('CustomerAddresses', [
            'foreignKey' => 'customer_id',
			'saveStrategy' => 'replace'
        ]);
		$this->belongsTo('Drivers');
        $this->belongsTo('Warehouses');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile')
			->add('mobile', [
				'length' => [
					'rule' => ['minLength', 10],
					'message' => 'mobile need to be at least 10 digit long',
				]
			]);

        return $validator;
    }
	
	
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['mobile']));

        return $rules;
    }
}

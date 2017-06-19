<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReferralDetails Model
 *
 * @property \App\Model\Table\FromCustomersTable|\Cake\ORM\Association\BelongsTo $FromCustomers
 * @property \App\Model\Table\ToCustomersTable|\Cake\ORM\Association\BelongsTo $ToCustomers
 *
 * @method \App\Model\Entity\ReferralDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReferralDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReferralDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReferralDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReferralDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReferralDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReferralDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ReferralDetailsTable extends Table
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

        $this->setTable('referral_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

     
		
		$this->belongsTo('fromCustomer', [
			'className' => 'Customers',
			'foreignKey' => 'to_customer_id',
			'propertyName' => 'from_customer',
		]);
		
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
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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
        $rules->add($rules->existsIn(['from_customer_id'], 'FromCustomers'));
        $rules->add($rules->existsIn(['to_customer_id'], 'ToCustomers'));

        return $rules;
    }
}

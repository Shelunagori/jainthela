<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JainCashPoints Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\JainCashPoint get($primaryKey, $options = [])
 * @method \App\Model\Entity\JainCashPoint newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JainCashPoint[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JainCashPoint|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JainCashPoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JainCashPoint[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JainCashPoint findOrCreate($search, callable $callback = null, $options = [])
 */
class JainCashPointsTable extends Table
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

        $this->setTable('jain_cash_points');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
		 $this->belongsTo('Orders');
		 $this->belongsTo('Banners');
		 $this->belongsTo('Carts');
		 $this->belongsTo('ReferralDetails');
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
            ->decimal('point')
            ->requirePresence('point', 'create')
            ->notEmpty('point');

        $validator
            ->decimal('used_point')
            ->requirePresence('used_point', 'create')
            ->notEmpty('used_point');

        $validator
            ->dateTime('updated_on')
            ->requirePresence('updated_on', 'create')
            ->notEmpty('updated_on');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WalkinSaleDetails Model
 *
 * @property \App\Model\Table\WalkinSalesTable|\Cake\ORM\Association\BelongsTo $WalkinSales
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\WalkinSaleDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSaleDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class WalkinSaleDetailsTable extends Table
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

        $this->setTable('walkin_sale_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('WalkinSales', [
            'foreignKey' => 'walkin_sale_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
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
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['walkin_sale_id'], 'WalkinSales'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}

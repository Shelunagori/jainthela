<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemLedgers Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\FranchisesTable|\Cake\ORM\Association\BelongsTo $Franchises
 * @property \App\Model\Table\PurchaseInwardVouchersTable|\Cake\ORM\Association\BelongsTo $PurchaseInwardVouchers
 *
 * @method \App\Model\Entity\ItemLedger get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemLedger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemLedger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemLedger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemLedger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemLedger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemLedger findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemLedgersTable extends Table
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

        $this->setTable('item_ledgers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
            'joinType' => 'INNER'
        ]);
		  $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
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
/* 
        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');
			
		$validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');
/* 
        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        
        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');
 */
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
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        $rules->add($rules->existsIn(['franchise_id'], 'Franchises'));
        $rules->add($rules->existsIn(['purchase_inward_voucher_id'], 'PurchaseInwardVouchers'));

        return $rules;
    }
}

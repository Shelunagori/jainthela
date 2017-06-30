<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransferInventoryVoucherRows Model
 *
 * @property \App\Model\Table\TransferInventoryVouchersTable|\Cake\ORM\Association\BelongsTo $TransferInventoryVouchers
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\TransferInventoryVoucherRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransferInventoryVoucherRow findOrCreate($search, callable $callback = null, $options = [])
 */
class TransferInventoryVoucherRowsTable extends Table
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

        $this->setTable('transfer_inventory_voucher_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('TransferInventoryVouchers', [
            'foreignKey' => 'transfer_inventory_voucher_id',
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
/* 
        $validator
            ->decimal('waste_quantity')
            ->requirePresence('waste_quantity', 'create')
            ->notEmpty('waste_quantity');
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
        $rules->add($rules->existsIn(['transfer_inventory_voucher_id'], 'TransferInventoryVouchers'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}

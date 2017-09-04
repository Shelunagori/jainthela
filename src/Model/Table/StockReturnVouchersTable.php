<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockReturnVouchers Model
 *
 * @property \App\Model\Table\DriversTable|\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\JainThelaAdminsTable|\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property \App\Model\Table\ItemLedgersTable|\Cake\ORM\Association\BelongsTo $ItemLedgers
 * @property \App\Model\Table\ItemLedgersTable|\Cake\ORM\Association\HasMany $ItemLedgers
 *
 * @method \App\Model\Entity\StockReturnVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockReturnVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockReturnVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockReturnVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockReturnVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockReturnVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockReturnVoucher findOrCreate($search, callable $callback = null, $options = [])
 */
class StockReturnVouchersTable extends Table
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

        $this->setTable('stock_return_vouchers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('JainThelaAdmins', [
            'foreignKey' => 'jain_thela_admin_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemLedgers', [
            'foreignKey' => 'item_ledger_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ItemLedgers', [
            'foreignKey' => 'stock_return_voucher_id'
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
            ->dateTime('created_on_date')
            ->requirePresence('created_on_date', 'create')
            ->notEmpty('created_on_date');

        $validator
            ->decimal('amount_receivable')
            ->requirePresence('amount_receivable', 'create')
            ->notEmpty('amount_receivable');

        $validator
            ->decimal('amount_received')
            ->requirePresence('amount_received', 'create')
            ->notEmpty('amount_received');

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
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'));
        $rules->add($rules->existsIn(['jain_thela_admin_id'], 'JainThelaAdmins'));

        return $rules;
    }
}

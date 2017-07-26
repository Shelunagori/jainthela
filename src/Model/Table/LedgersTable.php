<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ledgers Model
 *
 * @property \App\Model\Table\LedgerAccountsTable|\Cake\ORM\Association\BelongsTo $LedgerAccounts
 * @property \App\Model\Table\PurchaseBookingsTable|\Cake\ORM\Association\BelongsTo $PurchaseBookings
 * @property \App\Model\Table\WalkinSalesTable|\Cake\ORM\Association\BelongsTo $WalkinSales
 *
 * @method \App\Model\Entity\Ledger get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ledger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ledger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ledger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ledger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ledger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ledger findOrCreate($search, callable $callback = null, $options = [])
 */
class LedgersTable extends Table
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

        $this->setTable('ledgers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('LedgerAccounts', [
            'foreignKey' => 'ledger_account_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PurchaseBookings', [
            'foreignKey' => 'purchase_booking_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WalkinSales', [
            'foreignKey' => 'walkin_sale_id',
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
            ->decimal('debit')
            ->requirePresence('debit', 'create')
            ->notEmpty('debit');

        $validator
            ->decimal('credit')
            ->requirePresence('credit', 'create')
            ->notEmpty('credit');

        $validator
            ->dateTime('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

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
        $rules->add($rules->existsIn(['ledger_account_id'], 'LedgerAccounts'));
        $rules->add($rules->existsIn(['purchase_booking_id'], 'PurchaseBookings'));
        $rules->add($rules->existsIn(['walkin_sale_id'], 'WalkinSales'));

        return $rules;
    }
}

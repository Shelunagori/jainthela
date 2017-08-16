<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\PromoCodesTable|\Cake\ORM\Association\BelongsTo $PromoCodes
 * @property \App\Model\Table\OrderDetailsTable|\Cake\ORM\Association\HasMany $OrderDetails
 * @property |\Cake\ORM\Association\HasMany $Wallets
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('JainThelaAdmins', [
            'foreignKey' => 'jain_thela_admin_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PromoCodes', [
            'foreignKey' => 'promo_code_id'
        ]);
		$this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('OrderDetails', [
            'foreignKey' => 'order_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('Wallets', [
            'foreignKey' => 'order_id'
        ]);
		 $this->belongsTo('JainCashPoints', [
            'foreignKey' => 'order_id'
        ]);
		$this->belongsTo('CustomerAddresses');
		$this->belongsTo('CancelReasons');
		$this->belongsTo('Carts');
		$this->hasMany('CashBacks');
		$this->hasMany('ItemLedgers');
		$this->hasMany('ComboOfferDetails');
		$this->belongsTo('Drivers');
		$this->belongsTo('Warehouses');
    	$this->hasMany('DeliveryTimes');
    	$this->hasMany('Ledgers');
    	$this->hasMany('LedgerAccounts');
		$this->belongsTo('CancelReason');
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
            ->integer('order_no')
            ->requirePresence('order_no', 'create')
            ->notEmpty('order_no');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

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
        $rules->add($rules->existsIn(['jain_thela_admin_id'], 'JainThelaAdmins'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        //$rules->add($rules->existsIn(['promo_code_id'], 'PromoCodes'));

        return $rules;
    }
}

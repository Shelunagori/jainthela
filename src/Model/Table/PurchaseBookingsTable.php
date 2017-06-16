<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * PurchaseBookings Model
 *
 * @property \App\Model\Table\GrnsTable|\Cake\ORM\Association\BelongsTo $Grns
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\JainThelaAdminsTable|\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property \App\Model\Table\PurchaseBookingDetailsTable|\Cake\ORM\Association\HasMany $PurchaseBookingDetails
 *
 * @method \App\Model\Entity\PurchaseBooking get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseBooking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseBooking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseBooking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseBooking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseBooking findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseBookingsTable extends Table
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

        $this->setTable('purchase_bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Grns', [
            'foreignKey' => 'grn_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('JainThelaAdmins', [
            'foreignKey' => 'jain_thela_admin_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('LedgerAccounts');
		$this->belongsTo('Ledgers');
        $this->hasMany('PurchaseBookingDetails', [
            'foreignKey' => 'purchase_booking_id'
        ]);
		$this->hasMany('ItemLedgers', [
            'foreignKey' => 'purchase_booking_id'
        ]);
    }
	public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $data['transaction_date'] = trim(date('Y-m-d',strtotime($data['transaction_date'])));
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
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');


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
        $rules->add($rules->existsIn(['grn_id'], 'Grns'));
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));
        $rules->add($rules->existsIn(['jain_thela_admin_id'], 'JainThelaAdmins'));

        return $rules;
    }
}

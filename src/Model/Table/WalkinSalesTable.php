<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
/**
 * WalkinSales Model
 *
 * @property \App\Model\Table\DriversTable|\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\JainThelaAdminsTable|\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property \App\Model\Table\WarehousesTable|\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\WalkinSaleDetailsTable|\Cake\ORM\Association\HasMany $WalkinSaleDetails
 *
 * @method \App\Model\Entity\WalkinSale get($primaryKey, $options = [])
 * @method \App\Model\Entity\WalkinSale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WalkinSale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WalkinSale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WalkinSale findOrCreate($search, callable $callback = null, $options = [])
 */
class WalkinSalesTable extends Table
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

        $this->setTable('walkin_sales');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Drivers');
        $this->belongsTo('Orders');
        $this->belongsTo('JainThelaAdmins');
        $this->belongsTo('Warehouses');
		$this->belongsTo('Ledgers');
		$this->belongsTo('LedgersAccounts');
		$this->belongsTo('ItemLedgers');
        $this->hasMany('WalkinSaleDetails', [
            'foreignKey' => 'walkin_sale_id',
			'saveStrategy'=>'replace'
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
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

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
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'));
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'));

        return $rules;
    }
}

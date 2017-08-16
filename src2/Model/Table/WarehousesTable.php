<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Warehouses Model
 *
 * @property \App\Model\Table\JainThelaAdminsTable|\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property |\Cake\ORM\Association\HasMany $Grns
 * @property \App\Model\Table\ItemLedgersTable|\Cake\ORM\Association\HasMany $ItemLedgers
 * @property |\Cake\ORM\Association\HasMany $WalkinSales
 *
 * @method \App\Model\Entity\Warehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Warehouse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Warehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse findOrCreate($search, callable $callback = null, $options = [])
 */
class WarehousesTable extends Table
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

        $this->setTable('warehouses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('JainThelaAdmins', [
            'foreignKey' => 'jain_thela_admin_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Grns', [
            'foreignKey' => 'warehouse_id'
        ]);
        $this->hasMany('ItemLedgers', [
            'foreignKey' => 'warehouse_id'
        ]);
        $this->hasMany('WalkinSales', [
            'foreignKey' => 'warehouse_id'
        ]);
		$this->hasMany('PurchaseOutwards', [
            'foreignKey' => 'warehouse_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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

        return $rules;
    }
}

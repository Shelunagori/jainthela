<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \App\Model\Table\ItemCategoriesTable|\Cake\ORM\Association\BelongsTo $ItemCategories
 * @property \App\Model\Table\UnitsTable|\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\FranchisesTable|\Cake\ORM\Association\BelongsTo $Franchises
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemCategories', [
            'foreignKey' => 'item_category_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id'
        ]);
		
		
        $this->belongsTo('Franchises', [
            'foreignKey' => 'franchise_id',
            'joinType' => 'INNER'
        ]);
		
		$this->hasMany('ItemLedgers', [
            'foreignKey' => 'item_id'
        ]);
		$this->hasOne('Carts', [
            'foreignKey' => 'item_id'
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
/* 
        $validator
            ->requirePresence('alias_name', 'create')
            ->notEmpty('alias_name');
 */
        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->decimal('minimum_stock')
            ->requirePresence('minimum_stock', 'create')
            ->notEmpty('minimum_stock');
/* 
        $validator
            ->decimal('minimum_quantity_factor')
            ->requirePresence('minimum_quantity_factor', 'create')
            ->notEmpty('minimum_quantity_factor');
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
        $rules->add($rules->existsIn(['item_category_id'], 'ItemCategories'));
        $rules->add($rules->existsIn(['unit_id'], 'Units'));

        return $rules;
    }
}

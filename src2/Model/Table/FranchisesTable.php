<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Franchises Model
 *
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property |\Cake\ORM\Association\HasMany $Companies
 * @property \App\Model\Table\FranchiseItemCategoriesTable|\Cake\ORM\Association\HasMany $FranchiseItemCategories
 * @property |\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Franchise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Franchise newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Franchise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Franchise|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Franchise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Franchise[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Franchise findOrCreate($search, callable $callback = null, $options = [])
 */
class FranchisesTable extends Table
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

        $this->setTable('franchises');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		
		$this->belongsToMany('ItemCategories', [
            'foreignKey' => 'franchise_id',
            'targetForeignKey' => 'item_category_id',
            'joinTable' => 'franchise_item_categories'
        ]);
        $this->hasMany('FranchiseItemCategories', [
            'foreignKey' => 'franchise_id'
        ]);
		
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Companies', [
            'foreignKey' => 'franchise_id'
        ]);
        $this->hasMany('FranchiseItemCategories', [
            'foreignKey' => 'franchise_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'franchise_id'
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
        $rules->add($rules->existsIn(['username'], 'Users'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FranchiseItemCategories Model
 *
 * @property \App\Model\Table\FranchisesTable|\Cake\ORM\Association\BelongsTo $Franchises
 * @property \App\Model\Table\ItemCategoriesTable|\Cake\ORM\Association\BelongsTo $ItemCategories
 *
 * @method \App\Model\Entity\FranchiseItemCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FranchiseItemCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FranchiseItemCategoriesTable extends Table
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

        $this->setTable('franchise_item_categories');
        $this->setDisplayField('franchise_id');
        $this->setPrimaryKey(['franchise_id', 'item_category_id']);

        $this->belongsTo('Franchises', [
            'foreignKey' => 'franchise_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemCategories', [
            'foreignKey' => 'item_category_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['franchise_id'], 'Franchises'));
        $rules->add($rules->existsIn(['item_category_id'], 'ItemCategories'));

        return $rules;
    }
}

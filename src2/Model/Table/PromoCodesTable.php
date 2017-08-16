<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PromoCodes Model
 *
 * @property \App\Model\Table\ItemCategoriesTable|\Cake\ORM\Association\BelongsTo $ItemCategories
 * @property \App\Model\Table\JainThelaAdminsTable|\Cake\ORM\Association\BelongsTo $JainThelaAdmins
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\PromoCode get($primaryKey, $options = [])
 * @method \App\Model\Entity\PromoCode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PromoCode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PromoCode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PromoCode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PromoCode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PromoCode findOrCreate($search, callable $callback = null, $options = [])
 */
class PromoCodesTable extends Table
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

        $this->setTable('promo_codes');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemCategories', [
            'foreignKey' => 'item_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('JainThelaAdmins', [
            'foreignKey' => 'jain_thela_admin_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'promo_code_id'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->decimal('discount_per')
            ->requirePresence('discount_per', 'create')
            ->notEmpty('discount_per');

        $validator
            ->dateTime('valid_from')
            ->requirePresence('valid_from', 'create')
            ->notEmpty('valid_from');

        $validator
            ->dateTime('valid_to')
            ->requirePresence('valid_to', 'create')
            ->notEmpty('valid_to');

        /* $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on'); */

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
        $rules->add($rules->existsIn(['jain_thela_admin_id'], 'JainThelaAdmins'));

        return $rules;
    }
}

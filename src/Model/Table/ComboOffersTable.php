<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComboOffers Model
 *
 * @property \App\Model\Table\ComboOfferDetailsTable|\Cake\ORM\Association\HasMany $ComboOfferDetails
 *
 * @method \App\Model\Entity\ComboOffer get($primaryKey, $options = [])
 * @method \App\Model\Entity\ComboOffer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ComboOffer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComboOffer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComboOffer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ComboOffer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComboOffer findOrCreate($search, callable $callback = null, $options = [])
 */
class ComboOffersTable extends Table
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

        $this->setTable('combo_offers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ComboOfferDetails', [
            'foreignKey' => 'combo_offer_id',
			'saveStrategy'=>'replace'
        ]);
		
		 $this->hasMany('Orders', [
            'foreignKey' => 'combo_offer_id'
        ]);
		
		 $this->belongsTo('Items');
		  $this->belongsTo('Carts');
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

        $validator
            ->decimal('print_rate')
            ->requirePresence('print_rate', 'create')
            ->notEmpty('print_rate');

        $validator
            ->decimal('discount_per')
            ->requirePresence('discount_per', 'create')
            ->notEmpty('discount_per');

        $validator
            ->decimal('sales_rate')
            ->requirePresence('sales_rate', 'create')
            ->notEmpty('sales_rate');
/* 
        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');
 */
        return $validator;
    }
}

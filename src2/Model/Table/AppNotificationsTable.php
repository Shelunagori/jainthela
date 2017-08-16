<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppNotifications Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\AppNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AppNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class AppNotificationsTable extends Table
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

        $this->setTable('app_notifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id'
        ]);
		
		 $this->hasMany('AppNotificationCustomers', [
            'foreignKey' => 'app_notification_id'
        ]);
		 $this->belongsTo('Customers');
		 $this->belongsTo('DeepLinks');
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
            ->requirePresence('message', 'create')
            ->notEmpty('message');

       /*  $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image'); */

       /*  $validator
            ->requirePresence('app_link', 'create')
            ->notEmpty('app_link');

        $validator
            ->requirePresence('screen_type', 'create')
            ->notEmpty('screen_type');
  
        $validator
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
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PushNotifications Model
 *
 * @property \App\Model\Table\PushNotificationCustomerTable|\Cake\ORM\Association\HasMany $PushNotificationCustomer
 *
 * @method \App\Model\Entity\PushNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\PushNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PushNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PushNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PushNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class PushNotificationsTable extends Table
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

        $this->setTable('push_notifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('PushNotificationCustomers', [
            'foreignKey' => 'push_notification_id'
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

     /*    $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image'); 
			
		$validator
            ->requirePresence('link_url', 'create')
            ->notEmpty('link_url');
   */
        return $validator;
    }
}

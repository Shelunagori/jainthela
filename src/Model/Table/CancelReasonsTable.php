<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CancelReasons Model
 *
 * @method \App\Model\Entity\CancelReason get($primaryKey, $options = [])
 * @method \App\Model\Entity\CancelReason newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CancelReason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CancelReason|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CancelReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CancelReason[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CancelReason findOrCreate($search, callable $callback = null, $options = [])
 */
class CancelReasonsTable extends Table
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

        $this->setTable('cancel_reasons');
        $this->setDisplayField('reason');
        $this->setPrimaryKey('id');
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
            ->requirePresence('reason', 'create')
            ->notEmpty('reason');

        return $validator;
    }
}

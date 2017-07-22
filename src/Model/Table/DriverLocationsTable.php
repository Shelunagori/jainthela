<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DriverLocations Model
 *
 * @property \App\Model\Table\DriversTable|\Cake\ORM\Association\BelongsTo $Drivers
 *
 * @method \App\Model\Entity\DriverLocation get($primaryKey, $options = [])
 * @method \App\Model\Entity\DriverLocation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DriverLocation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DriverLocation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DriverLocation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DriverLocation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DriverLocation findOrCreate($search, callable $callback = null, $options = [])
 */
class DriverLocationsTable extends Table
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

        $this->setTable('driver_locations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
            'joinType' => 'INNER'
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
            ->requirePresence('lattitude', 'create')
            ->notEmpty('lattitude');

        $validator
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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

        return $rules;
    }
}

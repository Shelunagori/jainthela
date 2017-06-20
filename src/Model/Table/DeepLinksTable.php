<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeepLinks Model
 *
 * @method \App\Model\Entity\DeepLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeepLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeepLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeepLink|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeepLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeepLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeepLink findOrCreate($search, callable $callback = null, $options = [])
 */
class DeepLinksTable extends Table
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

        $this->setTable('deep_links');
        $this->setDisplayField('id');
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
            ->requirePresence('link_name', 'create')
            ->notEmpty('link_name');

        $validator
            ->requirePresence('link_url', 'create')
            ->notEmpty('link_url');

        return $validator;
    }
}

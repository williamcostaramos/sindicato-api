<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Convenios Model
 *
 * @method \App\Model\Entity\Convenio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Convenio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Convenio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Convenio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Convenio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Convenio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Convenio findOrCreate($search, callable $callback = null, $options = [])
 */
class ConveniosTable extends Table
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

        $this->setTable('convenios');
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
            ->scalar('texto')
            ->requirePresence('texto', 'create')
            ->notEmpty('texto');

        $validator
            ->scalar('urlImg')
            ->maxLength('urlImg', 255)
            ->requirePresence('urlImg', 'create')
            ->notEmpty('urlImg');

        return $validator;
    }
}

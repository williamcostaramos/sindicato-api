<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Informacao Model
 *
 * @method \App\Model\Entity\Informacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Informacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Informacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Informacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Informacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Informacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Informacao findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformacaoTable extends Table
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

        $this->setTable('informacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('titulo')
            ->maxLength('titulo', 255)
            ->requirePresence('titulo', 'create')
            ->notEmpty('titulo');

        $validator
            ->scalar('texto')
            ->requirePresence('texto', 'create')
            ->notEmpty('texto');

        $validator
            ->scalar('anexo')
            ->maxLength('anexo', 255)
            ->allowEmpty('anexo');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Publicidade Model
 *
 * @method \App\Model\Entity\Publicidade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Publicidade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Publicidade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Publicidade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publicidade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Publicidade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Publicidade findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PublicidadeTable extends Table
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

        $this->setTable('publicidade');
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
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->scalar('codigo_video')
            ->maxLength('codigo_video', 255)
            ->allowEmpty('codigo_video');

        return $validator;
    }
}

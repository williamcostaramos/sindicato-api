<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clube Model
 *
 * @property \App\Model\Table\ClubeFotosTable|\Cake\ORM\Association\HasMany $ClubeFotos
 *
 * @method \App\Model\Entity\Clube get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clube newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Clube[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clube|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clube patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clube[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clube findOrCreate($search, callable $callback = null, $options = [])
 */
class ClubeTable extends Table
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

        $this->setTable('clube');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ClubeFotos', [
            'foreignKey' => 'clube_id'
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
            ->scalar('texto')
            ->requirePresence('texto', 'create')
            ->notEmpty('texto');

        return $validator;
    }
}

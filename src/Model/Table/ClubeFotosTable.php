<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClubeFotos Model
 *
 * @property \App\Model\Table\ClubeTable|\Cake\ORM\Association\BelongsTo $Clube
 *
 * @method \App\Model\Entity\ClubeFoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClubeFoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClubeFoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClubeFoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClubeFoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClubeFoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClubeFoto findOrCreate($search, callable $callback = null, $options = [])
 */
class ClubeFotosTable extends Table
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

        $this->setTable('clube_fotos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clube', [
            'foreignKey' => 'clube_id',
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
            ->scalar('descricao')
            ->maxLength('descricao', 255)
            ->allowEmpty('descricao');

        $validator
            ->scalar('urlImg')
            ->maxLength('urlImg', 255)
            ->requirePresence('urlImg', 'create')
            ->notEmpty('urlImg');

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
        $rules->add($rules->existsIn(['clube_id'], 'Clube'));

        return $rules;
    }
}

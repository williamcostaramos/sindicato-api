<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tipoatendimento Model
 *
 * @property \App\Model\Table\TipoatendimentoTable|\Cake\ORM\Association\BelongsTo $Tipoatendimento
 *
 * @method \App\Model\Entity\Tipoatendimento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tipoatendimento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tipoatendimento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tipoatendimento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tipoatendimento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tipoatendimento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tipoatendimento findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoatendimentoTable extends Table
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

        $this->setTable('tipoatendimento');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tipoatendimento', [
            'foreignKey' => 'subtipo_id'
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
            ->integer('versao')
            ->allowEmpty('versao');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 255)
            ->allowEmpty('descricao');

        $validator
            ->decimal('valor')
            ->allowEmpty('valor');

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
        $rules->add($rules->existsIn(['subtipo_id'], 'Tipoatendimento'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Atendimentotramitacao Model
 *
 * @property \App\Model\Table\DepartamentoTable|\Cake\ORM\Association\BelongsTo $Departamento
 * @property \App\Model\Table\AtendimentoTable|\Cake\ORM\Association\BelongsTo $Atendimento
 * @property \App\Model\Table\DepartamentoTable|\Cake\ORM\Association\BelongsTo $Departamento
 * @property \App\Model\Table\UsuarioTable|\Cake\ORM\Association\BelongsTo $Usuario
 *
 * @method \App\Model\Entity\Atendimentotramitacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Atendimentotramitacao findOrCreate($search, callable $callback = null, $options = [])
 */
class AtendimentotramitacaoTable extends Table
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

        $this->setTable('atendimentotramitacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departamento', [
            'foreignKey' => 'departamentoDestino_id'
        ]);
        $this->belongsTo('Atendimento', [
            'foreignKey' => 'atendimento_id'
        ]);
        $this->belongsTo('Departamento', [
            'foreignKey' => 'departamentoOrigem_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioTramitacao_id'
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
            ->dateTime('dataTramitacao')
            ->allowEmpty('dataTramitacao');

        $validator
            ->dateTime('dataEnvio')
            ->allowEmpty('dataEnvio');

        $validator
            ->scalar('providencia')
            ->maxLength('providencia', 4294967295)
            ->allowEmpty('providencia');

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
        $rules->add($rules->existsIn(['departamentoDestino_id'], 'Departamento'));
        $rules->add($rules->existsIn(['atendimento_id'], 'Atendimento'));
        $rules->add($rules->existsIn(['departamentoOrigem_id'], 'Departamento'));
        $rules->add($rules->existsIn(['usuarioTramitacao_id'], 'Usuario'));

        return $rules;
    }
}

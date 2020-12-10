<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Atendimento Model
 *
 * @property \App\Model\Table\DepartamentoTable|\Cake\ORM\Association\BelongsTo $Departamento
 * @property \App\Model\Table\AssociadoTable|\Cake\ORM\Association\BelongsTo $Associado
 * @property \App\Model\Table\TipoatendimentoTable|\Cake\ORM\Association\BelongsTo $Tipoatendimento
 * @property \App\Model\Table\UsuarioTable|\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\EmpresaTable|\Cake\ORM\Association\BelongsTo $Empresa
 * @property \App\Model\Table\AtendimentoProcedimentosTable|\Cake\ORM\Association\HasMany $AtendimentoProcedimentos
 * @property \App\Model\Table\AtendimentoobservacaoTable|\Cake\ORM\Association\HasMany $Atendimentoobservacao
 * @property \App\Model\Table\AtendimentotramitacaoTable|\Cake\ORM\Association\HasMany $Atendimentotramitacao
 *
 * @method \App\Model\Entity\Atendimento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Atendimento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Atendimento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Atendimento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Atendimento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Atendimento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Atendimento findOrCreate($search, callable $callback = null, $options = [])
 */
class AtendimentoTable extends Table
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

        $this->setTable('atendimento');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departamento', [
            'foreignKey' => 'departamentoAtual_id'
        ]);
        $this->belongsTo('Associado', [
            'foreignKey' => 'associado_id'
        ]);
        $this->belongsTo('Tipoatendimento', [
            'foreignKey' => 'tipoAtendimento_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioOrigem_id'
        ]);
        $this->belongsTo('Departamento', [
            'foreignKey' => 'departamentoCriacao_id'
        ]);
        $this->belongsTo('Empresa', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('AtendimentoProcedimentos', [
            'foreignKey' => 'atendimento_id'
        ]);
        $this->hasMany('Atendimentoobservacao', [
            'foreignKey' => 'atendimento_id'
        ]);
        $this->hasMany('Atendimentotramitacao', [
            'foreignKey' => 'atendimento_id'
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
            ->scalar('assunto')
            ->maxLength('assunto', 255)
            ->allowEmpty('assunto');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmpty('status');

        $validator
            ->scalar('descricaoAtendimento')
            ->maxLength('descricaoAtendimento', 4294967295)
            ->allowEmpty('descricaoAtendimento');

        $validator
            ->dateTime('dataOrigem')
            ->allowEmpty('dataOrigem');

        $validator
            ->dateTime('dataFim')
            ->allowEmpty('dataFim');

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
        $rules->add($rules->existsIn(['departamentoAtual_id'], 'Departamento'));
        $rules->add($rules->existsIn(['associado_id'], 'Associado'));
        $rules->add($rules->existsIn(['tipoAtendimento_id'], 'Tipoatendimento'));
        $rules->add($rules->existsIn(['usuarioOrigem_id'], 'Usuario'));
        $rules->add($rules->existsIn(['departamentoCriacao_id'], 'Departamento'));
        $rules->add($rules->existsIn(['empresa_id'], 'Empresa'));

        return $rules;
    }
}

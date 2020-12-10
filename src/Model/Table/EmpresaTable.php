<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empresa Model
 *
 * @property \App\Model\Table\CidadeTable|\Cake\ORM\Association\BelongsTo $Cidade
 * @property \App\Model\Table\AtividadeTable|\Cake\ORM\Association\BelongsTo $Atividade
 * @property \App\Model\Table\EscritorioTable|\Cake\ORM\Association\BelongsTo $Escritorio
 * @property \App\Model\Table\CategoriaTable|\Cake\ORM\Association\BelongsTo $Categoria
 * @property \App\Model\Table\UsuarioTable|\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\AgendaTable|\Cake\ORM\Association\HasMany $Agenda
 * @property \App\Model\Table\AssociadoTable|\Cake\ORM\Association\HasMany $Associado
 * @property \App\Model\Table\AssociadohistoricoTable|\Cake\ORM\Association\HasMany $Associadohistorico
 * @property \App\Model\Table\AtendimentoTable|\Cake\ORM\Association\HasMany $Atendimento
 * @property \App\Model\Table\AtendimentoClinicoTable|\Cake\ORM\Association\HasMany $AtendimentoClinico
 * @property \App\Model\Table\AutorizaconvenioTable|\Cake\ORM\Association\HasMany $Autorizaconvenio
 * @property \App\Model\Table\EmpresaanexoTable|\Cake\ORM\Association\HasMany $Empresaanexo
 * @property \App\Model\Table\GrcsuTable|\Cake\ORM\Association\HasMany $Grcsu
 * @property \App\Model\Table\GuiaassistencialTable|\Cake\ORM\Association\HasMany $Guiaassistencial
 * @property \App\Model\Table\MovimentacaoTable|\Cake\ORM\Association\HasMany $Movimentacao
 * @property \App\Model\Table\ProfissionalTable|\Cake\ORM\Association\HasMany $Profissional
 * @property \App\Model\Table\SmsTable|\Cake\ORM\Association\HasMany $Sms
 *
 * @method \App\Model\Entity\Empresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa findOrCreate($search, callable $callback = null, $options = [])
 */
class EmpresaTable extends Table
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

        $this->setTable('empresa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cidade', [
            'foreignKey' => 'cidade_id'
        ]);
        $this->belongsTo('Atividade', [
            'foreignKey' => 'atividade_id'
        ]);
        $this->belongsTo('Escritorio', [
            'foreignKey' => 'escritorio_id'
        ]);
        $this->belongsTo('Categoria', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioAlteracao_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioCadastro_id'
        ]);
        $this->hasMany('Agenda', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Associado', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Associadohistorico', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Atendimento', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('AtendimentoClinico', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Autorizaconvenio', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Empresaanexo', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Grcsu', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Guiaassistencial', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Movimentacao', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Profissional', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->hasMany('Sms', [
            'foreignKey' => 'empresa_id'
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
            ->scalar('razaoSocial')
            ->maxLength('razaoSocial', 255)
            ->allowEmpty('razaoSocial');

        $validator
            ->scalar('nomeFantasia')
            ->maxLength('nomeFantasia', 255)
            ->allowEmpty('nomeFantasia');

        $validator
            ->scalar('endereco')
            ->maxLength('endereco', 255)
            ->allowEmpty('endereco');

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 255)
            ->allowEmpty('bairro');

        $validator
            ->scalar('cep')
            ->maxLength('cep', 255)
            ->allowEmpty('cep');

        $validator
            ->scalar('fone')
            ->maxLength('fone', 255)
            ->allowEmpty('fone');

        $validator
            ->scalar('inscricaoEstadual')
            ->maxLength('inscricaoEstadual', 255)
            ->allowEmpty('inscricaoEstadual');

        $validator
            ->scalar('cnpj')
            ->maxLength('cnpj', 255)
            ->allowEmpty('cnpj');

        $validator
            ->scalar('responsavel')
            ->maxLength('responsavel', 255)
            ->allowEmpty('responsavel');

        $validator
            ->scalar('site')
            ->maxLength('site', 255)
            ->allowEmpty('site');

        $validator
            ->scalar('situacao')
            ->allowEmpty('situacao');

        $validator
            ->dateTime('dataCadastro')
            ->allowEmpty('dataCadastro');

        $validator
            ->integer('estabelecimento')
            ->allowEmpty('estabelecimento');

        $validator
            ->integer('tipoIdentificacao')
            ->allowEmpty('tipoIdentificacao');

        $validator
            ->decimal('capitalSocial')
            ->allowEmpty('capitalSocial');

        $validator
            ->integer('quantidadeEmpregados')
            ->allowEmpty('quantidadeEmpregados');

        $validator
            ->scalar('fone2')
            ->maxLength('fone2', 255)
            ->allowEmpty('fone2');

        $validator
            ->dateTime('dataAbertura')
            ->allowEmpty('dataAbertura');

        $validator
            ->dateTime('dataUltimaAlteracao')
            ->allowEmpty('dataUltimaAlteracao');

        $validator
            ->scalar('celular')
            ->maxLength('celular', 20)
            ->allowEmpty('celular');

        $validator
            ->scalar('cpfResponsavel')
            ->maxLength('cpfResponsavel', 255)
            ->allowEmpty('cpfResponsavel');

        $validator
            ->scalar('issqn')
            ->maxLength('issqn', 255)
            ->allowEmpty('issqn');

        $validator
            ->scalar('isConvenio')
            ->allowEmpty('isConvenio');

        $validator
            ->scalar('isFornecedor')
            ->allowEmpty('isFornecedor');

        $validator
            ->scalar('contratoOrConvenio')
            ->maxLength('contratoOrConvenio', 10)
            ->allowEmpty('contratoOrConvenio');

        $validator
            ->scalar('links')
            ->maxLength('links', 4294967295)
            ->allowEmpty('links');

        $validator
            ->scalar('optanteSimples')
            ->allowEmpty('optanteSimples');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 10)
            ->allowEmpty('numero');

        $validator
            ->scalar('complemento')
            ->maxLength('complemento', 255)
            ->allowEmpty('complemento');

        $validator
            ->scalar('isAssociado')
            ->allowEmpty('isAssociado');
        
        $validator
            ->scalar('senha')
            ->maxLength('senha', 255)
            ->allowEmpty('senha');
        
        $validator
            ->dateTime('dataExpiracao')
            ->allowEmpty('dataExpiracao');
        
        $validator
            ->scalar('tokenFirebase')
            ->maxLength('tokenFirebase', 255)
            ->allowEmpty('tokenFirebase');
        
        $validator
            ->boolean('manterConectado')
            ->allowEmpty('manterConectado');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['cidade_id'], 'Cidade'));
        $rules->add($rules->existsIn(['atividade_id'], 'Atividade'));
        $rules->add($rules->existsIn(['escritorio_id'], 'Escritorio'));
        $rules->add($rules->existsIn(['categoria_id'], 'Categoria'));
        $rules->add($rules->existsIn(['usuarioAlteracao_id'], 'Usuario'));
        $rules->add($rules->existsIn(['usuarioCadastro_id'], 'Usuario'));

        return $rules;
    }
}

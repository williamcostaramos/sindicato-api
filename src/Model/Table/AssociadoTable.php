<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema;

/**
 * Associado Model
 *
 * @property \App\Model\Table\CidadeTable|\Cake\ORM\Association\BelongsTo $Cidade
 * @property \App\Model\Table\EmpresaTable|\Cake\ORM\Association\BelongsTo $Empresa
 * @property \App\Model\Table\ProfissaoTable|\Cake\ORM\Association\BelongsTo $Profissao
 * @property \App\Model\Table\AtividadeTable|\Cake\ORM\Association\BelongsTo $Atividade
 * @property \App\Model\Table\UsuarioTable|\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\CategoriaTable|\Cake\ORM\Association\BelongsTo $Categoria
 * @property \App\Model\Table\AgendaTable|\Cake\ORM\Association\HasMany $Agenda
 * @property \App\Model\Table\AssociadoanexoTable|\Cake\ORM\Association\HasMany $Associadoanexo
 * @property \App\Model\Table\AssociadobrindeTable|\Cake\ORM\Association\HasMany $Associadobrinde
 * @property \App\Model\Table\AssociadodependenteTable|\Cake\ORM\Association\HasMany $Associadodependente
 * @property \App\Model\Table\AssociadohistoricoTable|\Cake\ORM\Association\HasMany $Associadohistorico
 * @property \App\Model\Table\AssociadoobservacaoTable|\Cake\ORM\Association\HasMany $Associadoobservacao
 * @property \App\Model\Table\AssociadooposicaoTable|\Cake\ORM\Association\HasMany $Associadooposicao
 * @property \App\Model\Table\AtendimentoTable|\Cake\ORM\Association\HasMany $Atendimento
 * @property \App\Model\Table\AtendimentoClinicoTable|\Cake\ORM\Association\HasMany $AtendimentoClinico
 * @property \App\Model\Table\AutorizaconvenioTable|\Cake\ORM\Association\HasMany $Autorizaconvenio
 * @property \App\Model\Table\DeclaracaoatividaderuralTable|\Cake\ORM\Association\HasMany $Declaracaoatividaderural
 * @property \App\Model\Table\GrcsuTable|\Cake\ORM\Association\HasMany $Grcsu
 * @property \App\Model\Table\GuiaassistencialTable|\Cake\ORM\Association\HasMany $Guiaassistencial
 * @property \App\Model\Table\HospedagemTable|\Cake\ORM\Association\HasMany $Hospedagem
 * @property \App\Model\Table\SmsTable|\Cake\ORM\Association\HasMany $Sms
 * @property \App\Model\Table\BeneficioTable|\Cake\ORM\Association\BelongsToMany $Beneficio
 *
 * @method \App\Model\Entity\Associado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Associado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Associado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Associado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Associado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Associado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Associado findOrCreate($search, callable $callback = null, $options = [])
 */
class AssociadoTable extends Table
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

        $this->setTable('associado');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cidade', [
            'foreignKey' => 'cidade_id'
        ]);
        $this->belongsTo('Empresa', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->belongsTo('Cidade', [
            'foreignKey' => 'naturalidade_id'
        ]);
        $this->belongsTo('Profissao', [
            'foreignKey' => 'profissao_id'
        ]);
        $this->belongsTo('Atividade', [
            'foreignKey' => 'atividade_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioCadastro_id'
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuarioAlteracao_id'
        ]);
        $this->belongsTo('Cidade', [
            'foreignKey' => 'lotacao_id'
        ]);
        $this->belongsTo('Categoria', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->hasMany('Agenda', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadoanexo', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadobrinde', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadodependente', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadohistorico', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadoobservacao', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Associadooposicao', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Atendimento', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('AtendimentoClinico', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Autorizaconvenio', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Declaracaoatividaderural', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Grcsu', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Guiaassistencial', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Hospedagem', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Sms', [
            'foreignKey' => 'associado_id'
        ]);
        $this->belongsToMany('Beneficio', [
            'foreignKey' => 'associado_id',
            'targetForeignKey' => 'beneficio_id',
            'joinTable' => 'associado_beneficio'
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
            ->dateTime('dataNascimento')
            ->allowEmpty('dataNascimento');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->allowEmpty('nome');

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
            ->scalar('nacionalidade')
            ->maxLength('nacionalidade', 255)
            ->allowEmpty('nacionalidade');

        $validator
            ->scalar('telefone')
            ->maxLength('telefone', 255)
            ->allowEmpty('telefone');

        $validator
            ->scalar('celular')
            ->maxLength('celular', 255)
            ->allowEmpty('celular');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->dateTime('dataFiliacao')
            ->allowEmpty('dataFiliacao');

        $validator
            ->scalar('carteiraProfissional')
            ->maxLength('carteiraProfissional', 255)
            ->allowEmpty('carteiraProfissional');

        $validator
            ->scalar('estadoCivil')
            ->maxLength('estadoCivil', 255)
            ->allowEmpty('estadoCivil');

        $validator
            ->scalar('sexo')
            ->maxLength('sexo', 255)
            ->allowEmpty('sexo');

        $validator
            ->scalar('numeroSerie')
            ->maxLength('numeroSerie', 255)
            ->allowEmpty('numeroSerie');

        $validator
            ->scalar('CPF')
            ->maxLength('CPF', 255)
            ->allowEmpty('CPF');

        $validator
            ->scalar('RG')
            ->maxLength('RG', 255)
            ->allowEmpty('RG');

        $validator
            ->scalar('RGOrgEmissor')
            ->maxLength('RGOrgEmissor', 255)
            ->allowEmpty('RGOrgEmissor');

        $validator
            ->dateTime('RGExpedicao')
            ->allowEmpty('RGExpedicao');

        $validator
            ->scalar('pis')
            ->maxLength('pis', 255)
            ->allowEmpty('pis');

        $validator
            ->dateTime('dataAdmissao')
            ->allowEmpty('dataAdmissao');

        $validator
            ->scalar('escolaridade')
            ->maxLength('escolaridade', 255)
            ->allowEmpty('escolaridade');

        $validator
            ->scalar('nomePai')
            ->maxLength('nomePai', 255)
            ->allowEmpty('nomePai');

        $validator
            ->scalar('nomeMae')
            ->maxLength('nomeMae', 255)
            ->allowEmpty('nomeMae');

        $validator
            ->integer('situacao')
            ->requirePresence('situacao', 'create')
            ->notEmpty('situacao');

        $validator
            ->scalar('urlFoto')
            ->maxLength('urlFoto', 255)
            ->allowEmpty('urlFoto');

        $validator
            ->dateTime('vencimentoCarteirinha')
            ->allowEmpty('vencimentoCarteirinha');

        $validator
            ->scalar('referencia')
            ->maxLength('referencia', 255)
            ->allowEmpty('referencia');

        $validator
            ->scalar('confrontantes')
            ->maxLength('confrontantes', 255)
            ->allowEmpty('confrontantes');

        $validator
            ->scalar('apelido')
            ->maxLength('apelido', 255)
            ->allowEmpty('apelido');

        $validator
            ->scalar('tituloEleitor')
            ->maxLength('tituloEleitor', 255)
            ->allowEmpty('tituloEleitor');

        $validator
            ->scalar('tipoPessoa')
            ->maxLength('tipoPessoa', 255)
            ->allowEmpty('tipoPessoa');

        $validator
            ->scalar('matriculaAnt')
            ->maxLength('matriculaAnt', 255)
            ->allowEmpty('matriculaAnt');

        $validator
            ->scalar('telefone2')
            ->maxLength('telefone2', 255)
            ->allowEmpty('telefone2');

        $validator
            ->scalar('celular2')
            ->maxLength('celular2', 255)
            ->allowEmpty('celular2');

        $validator
            ->scalar('tipoPagamento')
            ->maxLength('tipoPagamento', 1)
            ->allowEmpty('tipoPagamento');

        $validator
            ->dateTime('dataDesfiliacao')
            ->allowEmpty('dataDesfiliacao');

        $validator
            ->dateTime('dataCadastro')
            ->allowEmpty('dataCadastro');

        $validator
            ->dateTime('dataUltimaAlteracao')
            ->allowEmpty('dataUltimaAlteracao');

        $validator
            ->scalar('numeroSindicalizacao')
            ->maxLength('numeroSindicalizacao', 255)
            ->allowEmpty('numeroSindicalizacao');

        $validator
            ->scalar('tipoServidor')
            ->maxLength('tipoServidor', 255)
            ->allowEmpty('tipoServidor');

        $validator
            ->dateTime('entregaCarteirinha')
            ->allowEmpty('entregaCarteirinha');

        $validator
            ->numeric('descontoMensalidade')
            ->allowEmpty('descontoMensalidade');

        $validator
            ->numeric('outrosDescontos')
            ->allowEmpty('outrosDescontos');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 10)
            ->allowEmpty('numero');

        $validator
            ->scalar('complemento')
            ->maxLength('complemento', 30)
            ->allowEmpty('complemento');

        $validator
            ->scalar('matriculaAtual')
            ->maxLength('matriculaAtual', 255)
            ->allowEmpty('matriculaAtual');

        $validator
            ->scalar('cadastroOnline')
            ->allowEmpty('cadastroOnline');
        
        $validator
            ->scalar('senha')
            ->maxLength('senha', 255)
            ->allowEmpty('senha');
        
        $validator
            ->dateTime('dataExpiracao')
            ->allowEmpty('dataExpiracao');
        
        $validator
            ->boolean('avaliado')
            ->allowEmpty('avaliado');
        
        $validator
            ->boolean('termoAceito')
            ->allowEmpty('termoAceito');
                    
        $validator
            ->scalar('tokenFirebase')
            ->maxLength('tokenFirebase', 255)
            ->allowEmpty('tokenFirebase');
        
        $validator
            ->boolean('freelancer')
            ->allowEmpty('freelancer');
        
        $validator
            ->boolean('manterConectado')
            ->allowEmpty('manterConectado');
        
        $validator
            ->scalar('ultContracheque')
            ->allowEmpty('ultContracheque');
        
        $validator
            ->scalar('fotoDocumento')
            ->allowEmpty('fotoDocumento');
        
        $validator
            ->scalar('foto3x4')
            ->allowEmpty('foto3x4');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresa'));
        $rules->add($rules->existsIn(['naturalidade_id'], 'Cidade'));
        $rules->add($rules->existsIn(['profissao_id'], 'Profissao'));
        $rules->add($rules->existsIn(['atividade_id'], 'Atividade'));
        $rules->add($rules->existsIn(['usuarioCadastro_id'], 'Usuario'));
        $rules->add($rules->existsIn(['usuarioAlteracao_id'], 'Usuario'));
        $rules->add($rules->existsIn(['lotacao_id'], 'Cidade'));
        $rules->add($rules->existsIn(['categoria_id'], 'Categoria'));

        return $rules;
    }
    
    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->columnType('situacao', 'bit');
        return $schema;
    }
    
    public function findAssociadoCidade(Query $query, array $options)
    {
        $query = $query->select(['c.descCidade', 'uf.siglaUF'])
                        ->autoFields(true)
                        ->join([
                            'c' => [
                                'table' => 'cidade',
                                'type' => 'LEFT',
                                'conditions' => 'Associado.cidade_id = c.id'
                            ],
                            'uf' => [
                                'table' => 'uf',
                                'type' => 'LEFT',
                                'conditions' => 'c.uf_id = uf.id'
                            ]
                        ]);
                
        return $query;
    }
}

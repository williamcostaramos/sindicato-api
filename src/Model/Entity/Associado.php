<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Associado Entity
 *
 * @property int $id
 * @property int $versao
 * @property \Cake\I18n\FrozenTime $dataNascimento
 * @property string $nome
 * @property string $endereco
 * @property string $bairro
 * @property string $cep
 * @property string $nacionalidade
 * @property string $telefone
 * @property string $celular
 * @property \Cake\I18n\FrozenTime $dataFiliacao
 * @property string $carteiraProfissional
 * @property string $estadoCivil
 * @property string $sexo
 * @property string $numeroSerie
 * @property string $CPF
 * @property string $RG
 * @property string $RGOrgEmissor
 * @property \Cake\I18n\FrozenTime $RGExpedicao
 * @property string $pis
 * @property \Cake\I18n\FrozenTime $dataAdmissao
 * @property string $escolaridade
 * @property string $nomePai
 * @property string $nomeMae
 * @property int $situacao
 * @property int $cidade_id
 * @property int $empresa_id
 * @property int $naturalidade_id
 * @property int $profissao_id
 * @property string $urlFoto
 * @property \Cake\I18n\FrozenTime $vencimentoCarteirinha
 * @property string $referencia
 * @property string $confrontantes
 * @property string $apelido
 * @property string $tituloEleitor
 * @property int $atividade_id
 * @property string $tipoPessoa
 * @property string $matriculaAnt
 * @property string $telefone2
 * @property string $celular2
 * @property string $tipoPagamento
 * @property \Cake\I18n\FrozenTime $dataDesfiliacao
 * @property \Cake\I18n\FrozenTime $dataCadastro
 * @property \Cake\I18n\FrozenTime $dataUltimaAlteracao
 * @property int $usuarioCadastro_id
 * @property int $usuarioAlteracao_id
 * @property string $numeroSindicalizacao
 * @property string $tipoServidor
 * @property \Cake\I18n\FrozenTime $entregaCarteirinha
 * @property float $descontoMensalidade
 * @property float $outrosDescontos
 * @property int $lotacao_id
 * @property int $categoria_id
 * @property string $numero
 * @property string $complemento
 * @property string $matriculaAtual
 * @property string $cadastroOnline
 * @property string $senha
 * @property bool $avaliado
 * @property bool $termoAceito
 * @property string tokenFirebase
 * @property \Cake\I18n\FrozenTime $dataExpiracao
 * @property bool $freelancer
 * @property bool $manterConectado
 * @property string $ultContracheque
 * @property string $fotoDocumento
 * @property string $foto3x4
 *
 * @property \App\Model\Entity\Cidade $cidade
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\Profissao $profissao
 * @property \App\Model\Entity\Atividade $atividade
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Categorium $categorium
 * @property \App\Model\Entity\Agenda[] $agenda
 * @property \App\Model\Entity\Associadoanexo[] $associadoanexo
 * @property \App\Model\Entity\Associadobrinde[] $associadobrinde
 * @property \App\Model\Entity\Associadodependente[] $associadodependente
 * @property \App\Model\Entity\Associadohistorico[] $associadohistorico
 * @property \App\Model\Entity\Associadoobservacao[] $associadoobservacao
 * @property \App\Model\Entity\Associadooposicao[] $associadooposicao
 * @property \App\Model\Entity\Atendimento[] $atendimento
 * @property \App\Model\Entity\AtendimentoClinico[] $atendimento_clinico
 * @property \App\Model\Entity\Autorizaconvenio[] $autorizaconvenio
 * @property \App\Model\Entity\Declaracaoatividaderural[] $declaracaoatividaderural
 * @property \App\Model\Entity\Grcsu[] $grcsu
 * @property \App\Model\Entity\Guiaassistencial[] $guiaassistencial
 * @property \App\Model\Entity\Hospedagem[] $hospedagem
 * @property \App\Model\Entity\Sm[] $sms
 * @property \App\Model\Entity\Beneficio[] $beneficio
 */
class Associado extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'versao' => true,
        'dataNascimento' => true,
        'nome' => true,
        'endereco' => true,
        'bairro' => true,
        'cep' => true,
        'nacionalidade' => true,
        'telefone' => true,
        'celular' => true,
        'email' => true,
        'dataFiliacao' => true,
        'carteiraProfissional' => true,
        'estadoCivil' => true,
        'sexo' => true,
        'numeroSerie' => true,
        'CPF' => true,
        'RG' => true,
        'RGOrgEmissor' => true,
        'RGExpedicao' => true,
        'pis' => true,
        'dataAdmissao' => true,
        'escolaridade' => true,
        'nomePai' => true,
        'nomeMae' => true,
        'situacao' => true,
        'cidade_id' => true,
        'empresa_id' => true,
        'naturalidade_id' => true,
        'profissao_id' => true,
        'urlFoto' => true,
        'vencimentoCarteirinha' => true,
        'referencia' => true,
        'confrontantes' => true,
        'apelido' => true,
        'tituloEleitor' => true,
        'atividade_id' => true,
        'tipoPessoa' => true,
        'matriculaAnt' => true,
        'telefone2' => true,
        'celular2' => true,
        'tipoPagamento' => true,
        'dataDesfiliacao' => true,
        'dataCadastro' => true,
        'dataUltimaAlteracao' => true,
        'usuarioCadastro_id' => true,
        'usuarioAlteracao_id' => true,
        'numeroSindicalizacao' => true,
        'tipoServidor' => true,
        'entregaCarteirinha' => true,
        'descontoMensalidade' => true,
        'outrosDescontos' => true,
        'lotacao_id' => true,
        'categoria_id' => true,
        'numero' => true,
        'complemento' => true,
        'matriculaAtual' => true,
        'cadastroOnline' => true,
        'cidade' => true,
        'empresa' => true,
        'profissao' => true,
        'atividade' => true,
        'usuario' => true,
        'categorium' => true,
        'agenda' => true,
        'associadoanexo' => true,
        'associadobrinde' => true,
        'associadodependente' => true,
        'associadohistorico' => true,
        'associadoobservacao' => true,
        'associadooposicao' => true,
        'atendimento' => true,
        'atendimento_clinico' => true,
        'autorizaconvenio' => true,
        'declaracaoatividaderural' => true,
        'grcsu' => true,
        'guiaassistencial' => true,
        'hospedagem' => true,
        'sms' => true,
        'beneficio' => true,
        'senha' => true,
        'dataExpiracao' => true,
        'avaliado' => true,
        'termoAceito' => true,
        'tokenFirebase' => true,
        'freelancer' => true,
        'manterConectado' => true,
        'ultContracheque' => true,
        'fotoDocumento' => true,
        'foto3x4'
    ];
    
    protected function _setSenha($senha)
    {
        return (new DefaultPasswordHasher)->hash($senha);
    }
}

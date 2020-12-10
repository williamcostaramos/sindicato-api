<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property int $versao
 * @property string $razaoSocial
 * @property string $nomeFantasia
 * @property string $endereco
 * @property string $bairro
 * @property string $cep
 * @property string $fone
 * @property string $inscricaoEstadual
 * @property string $cnpj
 * @property string $responsavel
 * @property string $site
 * @property string $situacao
 * @property \Cake\I18n\FrozenTime $dataCadastro
 * @property int $estabelecimento
 * @property int $cidade_id
 * @property int $atividade_id
 * @property int $escritorio_id
 * @property int $tipoIdentificacao
 * @property int $categoria_id
 * @property float $capitalSocial
 * @property int $quantidadeEmpregados
 * @property string $fone2
 * @property \Cake\I18n\FrozenTime $dataAbertura
 * @property \Cake\I18n\FrozenTime $dataUltimaAlteracao
 * @property int $usuarioAlteracao_id
 * @property int $usuarioCadastro_id
 * @property string $celular
 * @property string $cpfResponsavel
 * @property string $issqn
 * @property string $isConvenio
 * @property string $isFornecedor
 * @property string $contratoOrConvenio
 * @property string $links
 * @property string $optanteSimples
 * @property string $numero
 * @property string $complemento
 * @property string $isAssociado
 * @property string $senha
 * @property \Cake\I18n\FrozenTime $dataExpiracao
 * @property string $tokenFirebase
 * @property bool $manterConectado
 *
 * @property \App\Model\Entity\Cidade $cidade
 * @property \App\Model\Entity\Atividade $atividade
 * @property \App\Model\Entity\Escritorio $escritorio
 * @property \App\Model\Entity\Categorium $categorium
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Agenda[] $agenda
 * @property \App\Model\Entity\Associado[] $associado
 * @property \App\Model\Entity\Associadohistorico[] $associadohistorico
 * @property \App\Model\Entity\Atendimento[] $atendimento
 * @property \App\Model\Entity\AtendimentoClinico[] $atendimento_clinico
 * @property \App\Model\Entity\Autorizaconvenio[] $autorizaconvenio
 * @property \App\Model\Entity\Empresaanexo[] $empresaanexo
 * @property \App\Model\Entity\Grcsu[] $grcsu
 * @property \App\Model\Entity\Guiaassistencial[] $guiaassistencial
 * @property \App\Model\Entity\Movimentacao[] $movimentacao
 * @property \App\Model\Entity\Profissional[] $profissional
 * @property \App\Model\Entity\Sm[] $sms
 */
class Empresa extends Entity
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
        'razaoSocial' => true,
        'nomeFantasia' => true,
        'endereco' => true,
        'bairro' => true,
        'cep' => true,
        'fone' => true,
        'inscricaoEstadual' => true,
        'cnpj' => true,
        'responsavel' => true,
        'site' => true,
        'situacao' => true,
        'dataCadastro' => true,
        'estabelecimento' => true,
        'cidade_id' => true,
        'atividade_id' => true,
        'escritorio_id' => true,
        'tipoIdentificacao' => true,
        'categoria_id' => true,
        'capitalSocial' => true,
        'quantidadeEmpregados' => true,
        'fone2' => true,
        'dataAbertura' => true,
        'dataUltimaAlteracao' => true,
        'usuarioAlteracao_id' => true,
        'usuarioCadastro_id' => true,
        'celular' => true,
        'cpfResponsavel' => true,
        'issqn' => true,
        'isConvenio' => true,
        'isFornecedor' => true,
        'contratoOrConvenio' => true,
        'links' => true,
        'optanteSimples' => true,
        'numero' => true,
        'complemento' => true,
        'isAssociado' => true,
        'cidade' => true,
        'atividade' => true,
        'escritorio' => true,
        'categorium' => true,
        'usuario' => true,
        'agenda' => true,
        'associado' => true,
        'associadohistorico' => true,
        'atendimento' => true,
        'atendimento_clinico' => true,
        'autorizaconvenio' => true,
        'empresaanexo' => true,
        'grcsu' => true,
        'guiaassistencial' => true,
        'movimentacao' => true,
        'profissional' => true,
        'sms' => true,
        'senha' => true,
        'dataExpiracao' => true,
        'tokenFirebase' => true,
        'manterConectado' => true
    ];
    
    protected function _setSenha($senha)
    {
        return (new DefaultPasswordHasher)->hash($senha);
    }
}

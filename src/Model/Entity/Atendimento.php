<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Atendimento Entity
 *
 * @property int $id
 * @property int $versao
 * @property string $assunto
 * @property string $status
 * @property string $descricaoAtendimento
 * @property \Cake\I18n\FrozenTime $dataOrigem
 * @property \Cake\I18n\FrozenTime $dataFim
 * @property int $departamentoAtual_id
 * @property int $associado_id
 * @property int $tipoAtendimento_id
 * @property int $usuarioOrigem_id
 * @property int $departamentoCriacao_id
 * @property int $empresa_id
 *
 * @property \App\Model\Entity\Departamento $departamento
 * @property \App\Model\Entity\Associado $associado
 * @property \App\Model\Entity\Tipoatendimento $tipoatendimento
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\AtendimentoProcedimento[] $atendimento_procedimentos
 * @property \App\Model\Entity\Atendimentoobservacao[] $atendimentoobservacao
 * @property \App\Model\Entity\Atendimentotramitacao[] $atendimentotramitacao
 */
class Atendimento extends Entity
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
        'assunto' => true,
        'status' => true,
        'descricaoAtendimento' => true,
        'dataOrigem' => true,
        'dataFim' => true,
        'departamentoAtual_id' => true,
        'associado_id' => true,
        'tipoAtendimento_id' => true,
        'usuarioOrigem_id' => true,
        'departamentoCriacao_id' => true,
        'empresa_id' => true,
        'departamento' => true,
        'associado' => true,
        'tipoatendimento' => true,
        'usuario' => true,
        'empresa' => true,
        'atendimento_procedimentos' => true,
        'atendimentoobservacao' => true,
        'atendimentotramitacao' => true
    ];
}

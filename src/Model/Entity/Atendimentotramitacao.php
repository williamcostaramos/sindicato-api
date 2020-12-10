<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Atendimentotramitacao Entity
 *
 * @property int $id
 * @property int $versao
 * @property \Cake\I18n\FrozenTime $dataTramitacao
 * @property \Cake\I18n\FrozenTime $dataEnvio
 * @property string $providencia
 * @property int $departamentoDestino_id
 * @property int $atendimento_id
 * @property int $departamentoOrigem_id
 * @property int $usuarioTramitacao_id
 *
 * @property \App\Model\Entity\Departamento $departamento
 * @property \App\Model\Entity\Atendimento $atendimento
 * @property \App\Model\Entity\Usuario $usuario
 */
class Atendimentotramitacao extends Entity
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
        'dataTramitacao' => true,
        'dataEnvio' => true,
        'providencia' => true,
        'departamentoDestino_id' => true,
        'atendimento_id' => true,
        'departamentoOrigem_id' => true,
        'usuarioTramitacao_id' => true,
        'departamento' => true,
        'atendimento' => true,
        'usuario' => true
    ];
}

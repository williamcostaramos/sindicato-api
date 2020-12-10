<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmpresaPagamento Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $dataPagamento
 * @property \Cake\I18n\FrozenTime $dataModificada
 * @property string $codTransacao
 * @property string $status
 * @property float $valor
 * @property int $empresa_id
 * @property int $associado_id
 *
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\Associado $associado
 */
class EmpresaPagamento extends Entity
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
        'dataPagamento' => true,
        'dataModificada' => true,
        'codTransacao' => true,
        'status' => true,
        'valor' => true,
        'empresa_id' => true,
        'associado_id' => true,
        'empresa' => true,
        'associado' => true
    ];
}

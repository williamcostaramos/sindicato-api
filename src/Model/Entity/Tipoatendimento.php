<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tipoatendimento Entity
 *
 * @property int $id
 * @property int $versao
 * @property string $descricao
 * @property int $subtipo_id
 * @property float $valor
 *
 * @property \App\Model\Entity\Tipoatendimento $tipoatendimento
 */
class Tipoatendimento extends Entity
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
        'descricao' => true,
        'subtipo_id' => true,
        'valor' => true,
        'tipoatendimento' => true
    ];
}

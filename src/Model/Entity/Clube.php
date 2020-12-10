<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clube Entity
 *
 * @property int $id
 * @property string $texto
 *
 * @property \App\Model\Entity\ClubeFoto[] $clube_fotos
 */
class Clube extends Entity
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
        'texto' => true,
        'clube_fotos' => true
    ];
}

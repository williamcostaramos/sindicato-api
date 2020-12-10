<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClubeFoto Entity
 *
 * @property int $id
 * @property string $descricao
 * @property string $urlImg
 * @property int $clube_id
 *
 * @property \App\Model\Entity\Clube $clube
 */
class ClubeFoto extends Entity
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
        'descricao' => true,
        'urlImg' => true,
        'clube_id' => true,
        'clube' => true
    ];
}

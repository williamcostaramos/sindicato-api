<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppConfiguraco Entity
 *
 * @property int $id
 * @property string $tokePagseguro
 * @property string $emailPagseguro
 * @property float $valorTaxa
 * @property bool $habilitarCobranca
 */
class AppConfiguraco extends Entity
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
        'tokePagseguro' => true,
        'emailPagseguro' => true,
        'valorTaxa' => true,
        'habilitarCobranca' => true
    ];
}

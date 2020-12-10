<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Oauth2Client Entity
 *
 * @property int $id
 * @property string $client_id
 * @property string $secret
 *
 * @property \App\Model\Entity\Client $client
 */
class Oauth2Client extends Entity
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
        'client_id' => true,
        'secret' => true,
        'client' => true
    ];
}

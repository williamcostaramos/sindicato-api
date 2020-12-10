<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Oauth2Token Entity
 *
 * @property int $id
 * @property string $token
 * @property \Cake\I18n\FrozenTime $expiration_date
 * @property bool $auth_token
 */
class Oauth2Token extends Entity
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
        'token' => true,
        'expiration_date' => true,
        'auth_token' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}

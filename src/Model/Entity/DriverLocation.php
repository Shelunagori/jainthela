<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DriverLocation Entity
 *
 * @property int $id
 * @property int $driver_id
 * @property string $lattitude
 * @property string $longitude
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\Driver $driver
 */
class DriverLocation extends Entity
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
        '*' => true,
        'id' => false
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JainCashPoint Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property float $point
 * @property float $used_point
 * @property \Cake\I18n\FrozenTime $updated_on
 *
 * @property \App\Model\Entity\Customer $customer
 */
class JainCashPoint extends Entity
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

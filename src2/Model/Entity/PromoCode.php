<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PromoCode Entity
 *
 * @property int $id
 * @property string $code
 * @property float $discount_per
 * @property int $item_category_id
 * @property int $jain_thela_admin_id
 * @property \Cake\I18n\FrozenTime $valid_from
 * @property \Cake\I18n\FrozenTime $valid_to
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\ItemCategory $item_category
 * @property \App\Model\Entity\JainThelaAdmin $jain_thela_admin
 * @property \App\Model\Entity\Order[] $orders
 */
class PromoCode extends Entity
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

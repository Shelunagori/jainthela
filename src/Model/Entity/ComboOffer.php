<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ComboOffer Entity
 *
 * @property int $id
 * @property int $name
 * @property float $print_rate
 * @property float $discount_per
 * @property float $sales_rate
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\ComboOfferDetail[] $combo_offer_details
 */
class ComboOffer extends Entity
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

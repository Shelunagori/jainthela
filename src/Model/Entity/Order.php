<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $order_no
 * @property \Cake\I18n\FrozenDate $order_date
 * @property int $customer_id
 * @property float $delivery_charges
 * @property float $amount_from_wallet
 * @property float $amount_from_jain_cash
 * @property float $amount_from_promocode
 * @property int $promo_code_id
 * @property string $order_type
 * @property int $franchise_id
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\PromoCode $promo_code
 * @property \App\Model\Entity\Franchise $franchise
 * @property \App\Model\Entity\OrderDetail[] $order_details
 */
class Order extends Entity
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

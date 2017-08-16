<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOutwardDetail Entity
 *
 * @property int $id
 * @property int $purchase_outward_id
 * @property int $item_id
 * @property float $quantity
 * @property float $invoice_quantity
 * @property float $rate
 * @property float $amount
 *
 * @property \App\Model\Entity\PurchaseOutward $purchase_outward
 * @property \App\Model\Entity\Item $item
 */
class PurchaseOutwardDetail extends Entity
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

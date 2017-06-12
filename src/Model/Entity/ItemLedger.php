<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemLedger Entity
 *
 * @property int $id
 * @property int $item_id
 * @property int $franchise_id
 * @property float $rate
 * @property string $status
 * @property float $quantity
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $purchase_inward_voucher_id
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Franchise $franchise
 * @property \App\Model\Entity\PurchaseInwardVoucher $purchase_inward_voucher
 */
class ItemLedger extends Entity
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

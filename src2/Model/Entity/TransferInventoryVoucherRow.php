<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransferInventoryVoucherRow Entity
 *
 * @property int $id
 * @property int $transfer_inventory_voucher_id
 * @property int $item_id
 * @property float $quantity
 * @property float $waste_quantity
 *
 * @property \App\Model\Entity\TransferInventoryVoucher $transfer_inventory_voucher
 * @property \App\Model\Entity\Item $item
 */
class TransferInventoryVoucherRow extends Entity
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

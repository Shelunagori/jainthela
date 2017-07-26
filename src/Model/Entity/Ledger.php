<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ledger Entity
 *
 * @property int $id
 * @property int $ledger_account_id
 * @property int $purchase_booking_id
 * @property int $walkin_sale_id
 * @property float $debit
 * @property float $credit
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property \Cake\I18n\FrozenTime $edited_on
 *
 * @property \App\Model\Entity\LedgerAccount $ledger_account
 * @property \App\Model\Entity\PurchaseBooking $purchase_booking
 * @property \App\Model\Entity\WalkinSale $walkin_sale
 */
class Ledger extends Entity
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

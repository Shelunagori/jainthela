<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockReturnVoucher Entity
 *
 * @property int $id
 * @property int $driver_id
 * @property \Cake\I18n\FrozenTime $created_on_date
 * @property float $amount_receivable
 * @property float $amount_received
 * @property int $jain_thela_admin_id
 * @property int $item_ledger_id
 *
 * @property \App\Model\Entity\Driver $driver
 * @property \App\Model\Entity\JainThelaAdmin $jain_thela_admin
 * @property \App\Model\Entity\ItemLedger[] $item_ledgers
 */
class StockReturnVoucher extends Entity
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

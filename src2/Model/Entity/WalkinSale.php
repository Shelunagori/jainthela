<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WalkinSale Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $name
 * @property string $mobile
 * @property int $driver_id
 * @property int $jain_thela_admin_id
 * @property int $warehouse_id
 * @property float $total_amount
 *
 * @property \App\Model\Entity\Driver $driver
 * @property \App\Model\Entity\JainThelaAdmin $jain_thela_admin
 * @property \App\Model\Entity\Warehouse $warehouse
 * @property \App\Model\Entity\WalkinSaleDetail[] $walkin_sale_details
 */
class WalkinSale extends Entity
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

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property float $benifit_per
 * @property float $total_amount
 * @property int $jain_thela_admin_id
 * @property string $status
 *
 * @property \App\Model\Entity\JainThelaAdmin $jain_thela_admin
 * @property \App\Model\Entity\Wallet[] $wallets
 */
class Plan extends Entity
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

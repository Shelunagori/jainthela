<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FranchiseItemCategory Entity
 *
 * @property int $franchise_id
 * @property int $item_category_id
 *
 * @property \App\Model\Entity\Franchise $franchise
 * @property \App\Model\Entity\ItemCategory $item_category
 */
class FranchiseItemCategory extends Entity
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
        'franchise_id' => false,
        'item_category_id' => false
    ];
}

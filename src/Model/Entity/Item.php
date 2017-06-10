<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $name
 * @property int $item_category_id
 * @property int $unit_id
 * @property int $franchise_id
 * @property string $alias_name
 * @property string $description
 * @property float $minimum_stock
 * @property bool $freeze
 * @property float $minimum_quantity_factor
 *
 * @property \App\Model\Entity\ItemCategory $item_category
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Franchise $franchise
 */
class Item extends Entity
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

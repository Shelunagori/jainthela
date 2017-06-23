<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemSubCategory Entity
 *
 * @property int $id
 * @property int $item_category_id
 * @property string $name
 *
 * @property \App\Model\Entity\ItemCategory $item_category
 * @property \App\Model\Entity\Item[] $items
 */
class ItemSubCategory extends Entity
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

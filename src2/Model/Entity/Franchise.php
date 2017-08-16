<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Franchise Entity
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\FranchiseItemCategory[] $franchise_item_categories
 */
class Franchise extends Entity
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

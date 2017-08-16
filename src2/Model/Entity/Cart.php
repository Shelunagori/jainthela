<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $item_id
 * @property float $quantity
<<<<<<< HEAD
 * @property string $cart_count
=======
>>>>>>> 8ad41ceb2ec85f2b846b3156a3e5d37a6c786214
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Item $item
 */
class Cart extends Entity
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

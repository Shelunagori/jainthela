<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PushNotificationCustomer Entity
 *
 * @property int $id
 * @property int $push_notification_id
 * @property int $customer_id
 * @property int $sent
 *
 * @property \App\Model\Entity\PushNotification $push_notification
 * @property \App\Model\Entity\Customer $customer
 */
class PushNotificationCustomer extends Entity
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

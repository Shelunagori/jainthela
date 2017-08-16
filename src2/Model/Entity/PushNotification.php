<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PushNotification Entity
 *
 * @property int $id
 * @property string $message
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\PushNotificationCustomer[] $push_notification_customer
 */
class PushNotification extends Entity
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

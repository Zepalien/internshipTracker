<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $id
 * @property string $company_name
 * @property string $company_address
 * @property string $role
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modify
 */
class Application extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'company_name' => true,
        'company_address' => true,
        'role' => true,
        'status' => true,
        'created' => true,
        'modify' => true,
        'id' => false, // Prevent mass assignment of 'id'
        'interview_date' => true,
        'interview_type' => true,
        'interview_location' => true,
    ];
}

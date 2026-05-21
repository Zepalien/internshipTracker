<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity
 *
 * @property int $id
 * @property int|null $application_id
 * @property string $name
 * @property string $file_path
 * @property string $type
 * @property string $category
 * @property \Cake\I18n\DateTime $created
 *
 * @property \App\Model\Entity\Application $application
 */
class Document extends Entity
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
        'application_id' => true,
        'name' => true,
        'file_path' => true,
        'type' => true,
        'category' => true,
        'created' => true,
        'application' => true,
    ];
}

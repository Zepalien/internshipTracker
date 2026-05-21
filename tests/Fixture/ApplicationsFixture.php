<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
 */
class ApplicationsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'company_name' => 'Lorem ipsum dolor sit amet',
                'company_adress' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2026-05-08 02:15:32',
                'modify' => '2026-05-08 02:15:32',
            ],
        ];
        parent::init();
    }
}

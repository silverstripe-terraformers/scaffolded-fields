<?php

namespace Terraformers\ScaffoldedFields\Tests;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

/**
 * Class Entrance
 *
 * @property string $Title
 * @method House House()
 * @package Terraformers\ScaffoldedFields\Tests
 */
class Entrance extends DataObject implements TestOnly
{
    /**
     * @var string
     */
    private static $table_name = 'TestEntrance';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar',
    ];

    /**
     * @var array
     */
    private static $belongs_to = [
        'House' => House::class . '.Entrance',
    ];
}

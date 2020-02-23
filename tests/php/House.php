<?php

namespace Terraformers\ScaffoldedFields\Tests;

use SilverStripe\Assets\Image;
use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

/**
 * Class House
 *
 * @property string $Title
 * @property string $Address
 * @property int $EntranceID
 * @property int $ImageID
 * @method Entrance Entrance()
 * @method Image Image()
 * @package Terraformers\ScaffoldedFields\Tests
 */
class House extends DataObject implements TestOnly
{
    /**
     * @var string
     */
    private static $table_name = 'TestHouse';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar',
        'Address' => 'Varchar',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Image' => Image::class,
        'Entrance' => Entrance::class,
    ];
}

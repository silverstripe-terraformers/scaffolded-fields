<?php

namespace Terraformers\ScaffoldedFields\Tests;

use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\SapphireTest;
use Terraformers\ScaffoldedFields;

class ExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'ExtensionTest.yml';

    /**
     * @var array
     */
    protected static $extra_dataobjects = [
        Entrance::class,
        House::class,
    ];

    /**
     * @var array
     */
    protected static $required_extensions = [
        House::class => [
            ScaffoldedFields\Extension::class,
        ]
    ];

    /**
     * @param array $expected
     * @dataProvider fieldsProvider
     */
    public function testCmsFields(array $config, array $expected)
    {
        Config::modify()->set(House::class, 'field_removal', $config);

        /** @var House $house */
        $house = $this->objFromFixture(House::class, 'house1');

        $fields = $house->getCMSFields();
        $tab = $fields->findOrMakeTab('Root.Main');

        foreach ($expected as $fieldName => $present) {
            $field = $tab->fieldByName($fieldName);

            if ($present) {
                $this->assertNotNull($field);

                continue;
            }

            $this->assertNull($field);
        }
    }

    /**
     * @return array
     */
    public function fieldsProvider()
    {
        return [
            [
                [],
                [
                    'Title' => true,
                    'Address' => true,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'db',
                        'type' => ScaffoldedFields\Extension::TYPE_KEEP,
                        'fields' => [
                            'Title',
                        ],
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => false,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'db',
                        'type' => ScaffoldedFields\Extension::TYPE_KEEP,
                    ],
                ],
                [
                    'Title' => false,
                    'Address' => false,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'db',
                        'type' => ScaffoldedFields\Extension::TYPE_REMOVE,
                        'fields' => [
                            'Title',
                        ],
                    ],
                ],
                [
                    'Title' => false,
                    'Address' => true,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'db',
                        'type' => ScaffoldedFields\Extension::TYPE_REMOVE,
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => true,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'has_one',
                        'type' => ScaffoldedFields\Extension::TYPE_KEEP,
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => true,
                    'EntranceID' => false,
                    'Image' => false,
                ],
            ],
            [
                [
                    [
                        'property' => 'has_one',
                        'type' => ScaffoldedFields\Extension::TYPE_KEEP,
                        'fields' => [
                            'Entrance',
                        ],
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => true,
                    'EntranceID' => true,
                    'Image' => false,
                ],
            ],
            [
                [
                    [
                        'property' => 'has_one',
                        'type' => ScaffoldedFields\Extension::TYPE_REMOVE,
                        'fields' => [
                            'Image',
                        ],
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => true,
                    'EntranceID' => true,
                    'Image' => false,
                ],
            ],
            [
                [
                    [
                        'property' => 'extra',
                        'fields' => [
                            'Address',
                            'Entrance',
                        ],
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => false,
                    'EntranceID' => true,
                    'Image' => true,
                ],
            ],
            [
                [
                    [
                        'property' => 'extra',
                        'fields' => [
                            'Address',
                            'EntranceID',
                        ],
                    ],
                ],
                [
                    'Title' => true,
                    'Address' => false,
                    'EntranceID' => false,
                    'Image' => true,
                ],
            ],
        ];
    }
}

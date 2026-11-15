<?php

use SylvainJule\ImageRadioField;

load([
    'SylvainJule\\ImageRadioField'        => 'lib/fields/ImageradioField.php',
    'SylvainJule\\ImageRadio'             => 'lib/options/imageradio.php',
    'SylvainJule\\ImageRadioOption'       => 'lib/options/imageradio-option.php',
    'SylvainJule\\ImageRadioOptions'      => 'lib/options/imageradio-options.php',
    'SylvainJule\\ImageRadioOptionsApi'   => 'lib/options/imageradio-optionsapi.php',
    'SylvainJule\\ImageRadioOptionsQuery' => 'lib/options/imageradio-optionsquery.php',
], __DIR__);

Kirby::plugin('sylvainjule/imageradio', [
    'fields' => [
        'imageradio' => ImageRadioField::class,
    ],
]);

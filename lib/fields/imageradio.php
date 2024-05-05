<?php

namespace SylvainJule;

require_once dirname(__DIR__) . '/options/imageradio-optionsapi.php';
require_once dirname(__DIR__) . '/options/imageradio-optionsquery.php';
require_once dirname(__DIR__) . '/options/imageradio-factory.php';
require_once dirname(__DIR__) . '/options/imageradio-option.php';
require_once dirname(__DIR__) . '/options/imageradio-options.php';
require_once dirname(__DIR__) . '/options/imageradio.php';


$base = require kirby()->root('kirby') . '/config/fields/radio.php';


/* Merge new properties
--------------------------------*/

$base = array_merge_recursive($base, array(
    'options' => array(
        'baseUrl' => false,
    ),
    'props' => array(
        'fit' => function($fit = 'cover') {
            return $fit;
        },
        'back' => function($back = false) {
            return $back;
        },
        'mobile' => function($mobile = false) {
            return $mobile;
        },
        'ratio' => function($ratio = '1/1') {
            return $ratio;
        },
    ),
));


/* Replace existing properties
--------------------------------*/

$base = array_replace_recursive($base, array(
    'methods' => array(
        'getOptions' => function() {
            $props   = \Kirby\Field\FieldOptions::polyfill($this->props);
            $options = ImageRadio::factory($props['options']);

            return $options->render($this->model());
        },
    ),
));


return $base;

<?php

require_once dirname(__DIR__) . '/options/imageradio-optionsquery.php';
require_once dirname(__DIR__) . '/options/imageradio-options.php';


$base = require kirby()->root('kirby') . '/config/fields/radio.php';


/* Merge new properties
--------------------------------*/

$base = array_merge_recursive($base, array(
    'props' => array(
        'fit' => function($fit = 'cover') {
            return $fit;
        },
        'gap' => function($gap = false) {
            return $gap;
        },
        'mobile' => function($mobile = false) {
            return $mobile;
        },
        'ratio' => function($ratio = '1/1') {
        	$computed = 1;

            if (preg_match('/(\d+)(?:\s*)([\/])(?:\s*)(\d+)/', $ratio, $matches) !== false){
                $computed = $matches[3] / $matches[1];
            }
            
            $computed = $computed * 100;
            $ratio    = round($computed, 3, PHP_ROUND_HALF_DOWN);

            return $ratio;
        },
    ),
));


/* Replace existing properties
--------------------------------*/

$base = array_replace_recursive($base, array(
    'computed' => array(
    	'options' => function() {
    		return ImageRadioOptions::factory($this->options(), $this->props, $this->model());
        },
    ),
));


return $base;
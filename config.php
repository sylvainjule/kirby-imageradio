<?php

Kirby::plugin('sylvainjule/imageradio', [
	'fields' => array(
		'imageradio' => require_once __DIR__ . '/lib/fields/imageradio.php',
	),
    'methods' => array(
        'getImageRadioOptions' => function () {
            return Options::factory(
                $this->options(),
                $this->props,
                $this->model()
            );
        },
    )
]);
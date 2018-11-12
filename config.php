<?php

Kirby::plugin('sylvainjule/imageradio', [
	'fields' => array(
		'imageradio' => require_once __DIR__ . '/lib/fields/imageradio.php',
	),
]);
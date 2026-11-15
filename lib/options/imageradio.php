<?php

namespace SylvainJule;

use Kirby\Form\FieldOptions;

class ImageRadio extends FieldOptions {

    public static function factory(array $props, bool $safeMode = true): static {
        $options = match ($props['type']) {
            'api'    => ImageRadioOptionsApi::factory($props),
            'query'  => ImageRadioOptionsQuery::factory($props),
            default  => ImageRadioOptions::factory($props['options'] ?? [])
        };

        return new static($options, $safeMode);
    }
}

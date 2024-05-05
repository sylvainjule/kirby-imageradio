<?php

namespace SylvainJule;

class ImageRadio extends \Kirby\Field\FieldOptions {

    public static function factory(array $props, bool $safeMode = true): static
    {
        $options = match ($props['type']) {
            'api'    => ImageRadioOptionsApi::factory($props),
            'query'  => ImageRadioOptionsQuery::factory($props),
            default  => ImageRadioOptions::factory($props['options'] ?? [])
        };

        return new static($options, $safeMode);
    }
}

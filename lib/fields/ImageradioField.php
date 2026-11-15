<?php

namespace SylvainJule;

use Kirby\Form\Field\RadioField;
use Kirby\Form\FieldOptions;
use Kirby\Reflection\Attributes\Prop;

class ImageRadioField extends RadioField {
    #[Prop]
    protected string $fit = 'cover';

    #[Prop]
    protected bool|string $back = false;

    #[Prop]
    protected bool $mobile = false;

    #[Prop]
    protected string|int|float $ratio = '1/1';

    #[Prop(export: false)]
    protected array|string|null $query = null;

    #[Prop(export: false)]
    protected array|string|null $api = null;

    protected function fetchOptions(): array {
        $props = FieldOptions::polyfill([
            'options' => $this->options ?? [],
            'query'   => $this->query,
            'api'     => $this->api,
        ]);

        return ImageRadio::factory($props['options'])->render($this->model());
    }
}

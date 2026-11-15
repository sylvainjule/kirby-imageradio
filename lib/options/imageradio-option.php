<?php

namespace SylvainJule;

use Kirby\Cms\ModelWithContent;
use Kirby\Option\Option;
use Kirby\Toolkit\HtmlString;

class ImageRadioOption extends Option {
    public function __construct(
        string|int|float|null $value,
        bool $disabled = false,
        public string|null $image = null,
        string|null $icon = null,
        HtmlString|string|array|null $info = null,
        HtmlString|string|array|null $text = null,
        bool $resolve = true
    ) {
        parent::__construct(
            value: $value,
            disabled: $disabled,
            icon: $icon,
            info: $info,
            text: $text,
            resolve: $resolve
        );
    }

    public function render(ModelWithContent $model, bool $safeMode = true): array {
        return [
            ...parent::render($model, $safeMode),
            'image' => $this->image,
        ];
    }
}

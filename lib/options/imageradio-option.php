<?php

namespace SylvainJule;

use Kirby\Cms\ModelWithContent;


class ImageRadioOption extends \Kirby\Option\Option {
    public function __construct(
        public string|int|float|null $value,
        public bool $disabled = false,
        public string|null $image = null,
         public string|null $icon = null,
		public string|array|null $info = null,
		string|array|null $text = null
    ) {
		$this->text = $text ?? ['en' => $this->value];
    }

    public function render(ModelWithContent $model): array
    {
        return [
            ...parent::render($model),
            'image' => $this->image
        ];
    }
}

<?php

namespace SylvainJule;

use Kirby\Blueprint\Factory;
use Kirby\Blueprint\NodeIcon;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\NodeString;
use Kirby\Cms\ModelWithContent;


class ImageRadioOption extends \Kirby\Option\Option {
    public function __construct(
        public string|int|float|null $value,
        public bool $disabled = false,
        public NodeIcon|null $icon = null,
        public NodeText|null $info = null,
        public NodeText|null $text = null,
        public NodeString|null $image = null,
    ) {
        $this->text ??= new NodeText(['en' => $this->value]);
    }
    public static function factory(string|int|float|null|array $props): static
    {

        $props = ImageRadioFactory::apply($props, [
            'icon'  => NodeIcon::class,
            'info'  => NodeText::class,
            'text'  => NodeText::class,
            'image' => NodeString::class,
        ]);

        return new static(...$props);
    }
    public function render(ModelWithContent $model): array
    {
        return [
            'disabled' => $this->disabled,
            'icon'     => $this->icon?->render($model),
            'info'     => $this->info?->render($model),
            'text'     => $this->text?->render($model),
            'image'    => $this->image?->render($model),
            'value'    => $this->value
        ];
    }
}

<?php

namespace SylvainJule;

use Kirby\Cms\Block;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\StructureObject;
use Kirby\Cms\User;
use Kirby\Content\Field;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;

class ImageRadioOptionsQuery extends \Kirby\Option\OptionsQuery {
    public function __construct(
        public string $query,
        public string|null $text = null,
        public string|null $value = null,
        public string|null $image = null
    ) {
    }

    public static function factory(string|array $props): static
    {
        if (is_string($props) === true) {
            return new static(query: $props);
        }

        return new static(
            query: $props['query'] ?? $props['fetch'],
            text: $props['text'] ?? null,
            value: $props['value'] ?? null,
            image: $props['image'] ?? null
        );
    }

    protected function itemToDefaults(array|object $item): array
    {
        return match (true) {
            is_array($item),
            $item instanceof Obj => [
                'arrayItem',
                '{{ item.value }}',
                '{{ item.value }}',
                '{{ item.value }}'
            ],

            $item instanceof StructureObject => [
                'structureItem',
                '{{ item.title }}',
                '{{ item.id }}'
            ],

            $item instanceof Block => [
                'block',
                '{{ block.type }}: {{ block.id }}',
                '{{ block.id }}'
            ],

            $item instanceof Page => [
                'page',
                '{{ page.title }}',
                '{{ page.id }}'
            ],

            $item instanceof File => [
                'file',
                '{{ file.filename }}',
                '{{ file.id }}'
            ],

            $item instanceof User => [
                'user',
                '{{ user.username }}',
                '{{ user.email }}'
            ],

            default => [
                'item',
                '{{ item.value }}',
                '{{ item.value }}',
                '{{ item.value }}'
            ]
        };
    }

    public function resolve(ModelWithContent $model, bool $safeMode = true): \Kirby\Option\Options
    {
        // use cached options if present
        // @codeCoverageIgnoreStart
        if ($this->options !== null) {
            return $this->options;
        }
        // @codeCoverageIgnoreEnd

        // run query
        $result = $model->query($this->query);

        // the query already returned an options collection
        if ($result instanceof ImageRadioOptions) {
            return $result;
        }

        // convert result to a collection
        if (is_array($result) === true) {
            $result = $this->collection($result);
        }

        if ($result instanceof Collection === false) {
            $type = is_object($result) === true ? get_class($result) : gettype($result);

            throw new InvalidArgumentException('Invalid query result data: ' . $type);
        }

        // create options array
        $options = $result->toArray(function ($item) use ($model, $safeMode) {
            // get defaults based on item type
            [$alias, $text, $value] = $this->itemToDefaults($item);
            $data = ['item' => $item, $alias => $item];

            // value is always a raw string
            $value = $model->toString($this->value ?? $value, $data);

            // text is only a raw string when using {< >}
            // or when the safe mode is explicitly disabled (select field)
            $safeMethod = $safeMode === true ? 'toSafeString' : 'toString';
            $text = $model->$safeMethod($this->text ?? $text, $data);
            $image = $model->$safeMethod($this->image ?? $image, $data);

            return compact('text', 'value', 'image');
        });

        return $this->options = ImageRadioOptions::factory($options);
    }
}

<?php

namespace SylvainJule;

use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Nest;
use Kirby\Content\Field;
use Kirby\Data\Json;
use Kirby\Exception\NotFoundException;
use Kirby\Http\Remote;
use Kirby\Http\Url;
use Kirby\Query\Query;


class ImageRadioOptionsApi extends \Kirby\Option\OptionsApi {
    public function __construct(
        public string $url,
        public string|null $query = null,
        public string|null $text = null,
        public string|null $value = null,
        public string|null $image = null
    ) {
    }

    public static function factory(string|array $props): static
    {
        if (is_string($props) === true) {
            return new static(url: $props);
        }

        return new static(
            url: $props['url'],
            query: $props['query'] ?? $props['fetch'] ?? null,
            text: $props['text'] ?? null,
            value: $props['value'] ?? null,
            image: $props['image'] ?? null
        );
    }



    public function resolve(ModelWithContent $model, bool $safeMode = true): \Kirby\Option\Options
    {
        // use cached options if present
        // @codeCoverageIgnoreStart
        if ($this->options !== null) {
            return $this->options;
        }
        // @codeCoverageIgnoreEnd

        // apply property defaults
        $this->defaults();

        // load data from URL and convert from JSON to array
        $data = $this->load($model);

        // @codeCoverageIgnoreStart
        if ($data === null) {
            throw new NotFoundException('Options could not be loaded from API: ' . $model->toSafeString($this->url));
        }
        // @codeCoverageIgnoreEnd

        // turn data into Nest so that it can be queried
        // or field methods applied to the data
        $data = Nest::create($data);

        // optionally query a substructure inside the data array
        $data    = Query::factory($this->query)->resolve($data);
        $options = [];

        // create options by resolving text and value query strings
        // for each item from the data
        foreach ($data as $key => $item) {
            // convert simple `key: value` API data
            if (is_string($item) === true) {
                $item = new Field(null, $key, $item);
            }

            $safeMethod = $safeMode === true ? 'toSafeString' : 'toString';

            $options[] = [
                // value is always a raw string
                'value' => $model->toString($this->value, ['item' => $item]),
                // text is only a raw string when using {< >}
                // or when the safe mode is explicitly disabled (select field)
                'text' => $model->$safeMethod($this->text, ['item' => $item]),
                'image' => $model->$safeMethod($this->image, ['item' => $item]),
            ];
        }

        // create Options object and render this subsequently
        return $this->options = ImageRadioOptions::factory($options);
    }
}

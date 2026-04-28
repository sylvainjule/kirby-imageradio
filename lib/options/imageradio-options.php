<?php

namespace SylvainJule;

class ImageRadioOptions extends \Kirby\Option\Options {
    public static function factory(array $items = [], bool $resolve = true): static {
        $collection = new static();

        // We format the correct image url here ↓
        $baseUrl = option('sylvainjule.imageradio.baseUrl') ?? kirby()->url('assets') . '/images';
        $baseUrl = kirby()->site()->toSafeString($baseUrl);
        $baseUrl = rtrim($baseUrl, '/');

        foreach($items as $key => $option) {
            if (is_array($option) && isset($option['image'])) {
                $image = $option['image'];
                if(!str_starts_with($image, 'http')) {
                    $items[$key]['image'] = $baseUrl .'/'. $image;
                }
            }
        }

        foreach ($items as $key => $option) {
            if (is_array($option) === false || array_key_exists('value', $option) === false) {
                if(is_string($key)) {
                    if (is_array($option)) {
                        $option['value'] = $key;  // preserve image/text/etc., just inject value
                    } else {
                        $option = ['value' => $key, 'text' => $option];
                    }
                } else {
                    $option = ['value' => $option];
                }
            }
            $option = ImageRadioOption::factory($option);
            $collection->__set($option->id(), $option);
        }

        return $collection;
    }
}

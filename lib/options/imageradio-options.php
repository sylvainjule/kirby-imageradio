<?php

use Kirby\Form\Options;
use Kirby\Cms\App;

class ImageRadioOptions extends Options {
	public static function api($api, $model = null): array {
        $model = $model ?? App::instance()->site();
        $fetch = null;
        $text  = null;
        $value = null;
        $image = null;
        if (is_array($api) === true) {
            $fetch = $api['fetch'] ?? null;
            $text  = $api['text']  ?? null;
            $value = $api['value'] ?? null;
            $image = $api['image'] ?? null;
            $url   = $api['url']   ?? null;
        } else {
            $url = $api;
        }
        $optionsApi = new ImageRadioOptionsApi([
            'data'  => static::data($model),
            'fetch' => $fetch,
            'url'   => $url,
            'text'  => $text,
            'value' => $value,
            'image' => $image
        ]);
        return $optionsApi->options();
    }

    public static function factory($options, array $props = [], $model = null): array {
        switch ($options) {
            case 'api':
                $options = static::api($props['api']);
                break;
            case 'query':
                $options = static::query($props['query'], $model);
                break;
            case 'children':
            case 'grandChildren':
            case 'siblings':
            case 'index':
            case 'files':
            case 'images':
            case 'documents':
            case 'videos':
            case 'audio':
            case 'code':
            case 'archives':
                $options = static::query('page.' . $options, $model);
                break;
            case 'pages':
                $options = static::query('site.index', $model);
                break;
        }

        if (is_array($options) === false) {
            return [];
        }

        $baseUrl = option('sylvainjule.imageradio.baseUrl') ?? kirby()->url('assets') . '/images';
        $baseUrl = $model->toString($baseUrl);
        $baseUrl = rtrim($baseUrl, '/');
        $result  = [];

        foreach ($options as $key => $option) {
            if (is_array($option) === false || isset($option['value']) === false) {
                $option = [
                    'value' => is_int($key) ? $option : $key,
                    'text'  => $option['text'],
                    'image' => $baseUrl . '/' . $option['image'],
                ];
            }
            elseif (is_array($option) === false || isset($option['value']) === true) {
                $option = [
                    'value' => $option['value'],
                    'text'  => $option['text'],
                    'image' => $option['image'],
                ];
            }
            // translate the option text
            $option['text'] = I18n::translate($option['text'], $option['text']);
            // add the option to the list
            $result[] = $option;
        }

        return $result;
    }

    public static function query($query, $model = null): array {
        $model = $model ?? App::instance()->site();

        // resolve array query setup
        if (is_array($query) === true) {
            $text  = $query['text']  ?? '{{ file.filename }}';
            $value = $query['value'] ?? '{{ file.id }}';
            $image = $query['image'] ?? '{{ file.url }}';
            $query = $query['fetch'] ?? null;
        }
        $optionsQuery = new ImageRadioOptionsQuery([
            'aliases' => static::aliases(),
            'data'    => static::data($model),
            'query'   => $query,
            'text'    => $text,
            'value'   => $value,
            'image'   => $image,
        ]);
        return $optionsQuery->options();
    }
}

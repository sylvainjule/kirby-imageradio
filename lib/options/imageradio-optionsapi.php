<?php

use Kirby\Cms\Nest;
use Kirby\Form\OptionsApi;
use Kirby\Toolkit\Query;

class ImageRadioOptionsApi extends OptionsApi {
    /**
     * @var string
     */
    protected $image = '{{ item.image }}';

    /**
     * @return array
     * @throws \Exception
     * @throws \Kirby\Exception\InvalidArgumentException
     */
    public function options(): array
    {
        if (is_array($this->options) === true) {
            return $this->options;
        }

        if (Url::isAbsolute($this->url()) === true) {
            // URL, request via cURL
            $data = Remote::get($this->url())->json();
        } else {
            // local file, get contents locally

            // ensure the file exists before trying to load it as the
            // file_get_contents() warnings need to be suppressed
            if (is_file($this->url()) !== true) {
                throw new Exception('Local file ' . $this->url() . ' was not found');
            }

            $content = @file_get_contents($this->url());

            if (is_string($content) !== true) {
                throw new Exception('Unexpected read error'); // @codeCoverageIgnore
            }

            if (empty($content) === true) {
                return [];
            }

            $data = json_decode($content, true);
        }

        if (is_array($data) === false) {
            throw new InvalidArgumentException('Invalid options format');
        }

        $result  = (new Query($this->fetch(), Nest::create($data)))->result();
        $options = [];

        foreach ($result as $item) {
            // dump($item);
            $data = array_merge($this->data(), ['item' => $item]);

            $options[] = [
                'text'  => $this->field('text', $data),
                'value' => $this->field('value', $data),
                // added this ↓
                'image' => $this->field('image', $data),
            ];
        }

        return $options;
    }

    /**
     * @param string $text
     * @return $this
     */
    protected function setImage(?string $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function image(): string
    {
        return $this->image;
    }
}

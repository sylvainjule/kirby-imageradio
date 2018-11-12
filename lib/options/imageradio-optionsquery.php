<?php

use Kirby\Form\OptionsQuery;
use Kirby\Toolkit\Query;

class ImageRadioOptionsQuery extends OptionsQuery {
    protected $image;

    public function options(): array {
        if (is_array($this->options) === true) {
            return $this->options;
        }

        $data    = $this->data();
        $query   = new Query($this->query(), $this->data());
        $result  = $query->result();
        $result  = $this->resultToCollection($result);
        $options = [];
        foreach ($result as $item) {
            $alias = $this->resolve($item);
            $data  = array_merge($data, [$alias => $item]);
            $options[] = [
                'text'  => $this->template($alias, 'text', $data),
                'value' => $this->template($alias, 'value', $data),
                'image' => $this->template($alias, 'image', $data)
            ];
        }
        return $this->options = $options;
    }

    protected function setImage($image) {
        $this->image = $image;
        return $this;
    }
	public function image() {
        return $this->image;
    }
}
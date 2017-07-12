<?php

class IllustratedRadioField extends InputField {

    static public $assets = array(
        'css' => array(
            'styles.css'
        )
    );
    
    public $columns = 2;
    protected $cache;

    public function value() {
        $value = parent::value();
        if(empty($value)) {
            // get the first key of options
            $options = $this->options();
            if(is_array($options)) {
                reset($options);
                $value = key($options);        
            }
        }
        return $value;
    }
    public function input() {
        $val   = func_get_arg(0);
        $input = parent::input();
        $input->removeClass('input');
        $input->addClass('radio');
        $input->attr('type', 'radio');
        $input->val($val);

        if($this->readonly) {
            $input->attr('disabled', true);      
        }

        $input->attr('checked', $val == $this->value());
        return $input;
    }
    public function label() {
        $label = parent::label();
        if(is_null($label)) return null;

        // use a legend to avoid having a label
        // that is just connected to the first input
        return $label->tag('legend')->attr('for', false);
    }
    public function options() {
        if($this->cache) return $this->cache;

        return $this->cache = fieldoptions::build($this);
    }
    
    
    public function item($value, $options) {

        $input = $this->input($value);
        
        // Get label and filename of the input
        $text = $options['label'];
        $image = $options['image'];
        
        // Find image url
        $imageurl = kirby()->urls()->assets() .'/images/'. $image;

        // Get mobile status if specified | default : false
        $mobile = $this->mobile() ? $this->position() : false;
        $mobileClass = $mobile ? '' : ' mobile-disabled';
        
        // Go with an img tag if there's no ratio specified
        if (!$this->ratio()) {
            $imageDiv = '<img src="'. $imageurl .'">';
            $imageDiv = '<div class="radio-illustration'. $mobileClass .'">'. $imageDiv .'</div>';
        }
        // Otherwise, set the image as background
        else {
            // Get and convert ratio (3/2 -> 66.6%)
            $ratio = $this->ratio();
            $convertedRatio = 1;
            
            if (preg_match('/(\d+)(?:\s*)([\/])(?:\s*)(\d+)/', $ratio, $matches) !== false){
                $convertedRatio = $matches[3] / $matches[1];
            }
            
            $convertedRatio = $convertedRatio * 100;
            $convertedRatio = round($convertedRatio, 3, PHP_ROUND_HALF_DOWN);
            $ratio = $convertedRatio;
            
            // Get position if specified | default : centered
            $position = $this->position() ? $this->position() : 'center center';
            
            $imageDiv = '<div class="radio-illustration as-background'. $mobileClass .'" style="background-image: url('. $imageurl .'); background-position: '. $position .'; padding-top: '. $ratio .'%;"></div>';
        }
        

        
        $label = new Brick('label');
        $label->addClass('input');
        $label->addClass('input-with-radio');
        $label->attr('data-focus', 'true');
        $label->append($imageDiv);
        $label->append($input);
        $label->append('<span>' . $this->i18n($text) . '</span>');

        if($this->readonly) {
            $label->addClass('input-is-readonly');
        }

        return $label;

    }
    
    public function content() {

        $html = '<ul class="input-list field-grid cf">';

        switch($this->columns()) {
            case 2:
                $width = ' field-grid-item-1-2';
                break;
            case 3:
                $width = ' field-grid-item-1-3';
                break;
            case 4:
                $width = ' field-grid-item-1-4';
                break;
            case 5:
                $width = ' field-grid-item-1-5';
                break;
            default:
                $width = '';
                break;
        }

        foreach($this->options() as $key => $value) {
            
            
            $html .= '<li class="input-list-item field-grid-item' . $width . '">';
            $html .= $this->item($key, $value);
            $html .= '</li>';
        }

        $html .= '</ul>';

        $content = new Brick('div');
        $content->addClass('field-content');
        $content->append($html);

        return $content;

    }

    public function validate() {
        if(is_array($this->value())) {
            foreach($this->value() as $v) {
                if(!array_key_exists($v, $this->options())) return false;
            }
            return true;
        } else {
            return array_key_exists($this->value(), $this->options());
        }
    }

}

<?php

namespace SylvainJule;

class ImageRadioFactory extends \Kirby\Blueprint\Factory {
    public static function apply(array $properties, array $factories): array
    {

        foreach ($factories as $property => $class) {
            // skip non-existing properties, empty properties
            // or properties that are matching objects
            if (
                isset($properties[$property]) === false ||
                $properties[$property] === null ||
                is_a($properties[$property], $class) === true
            ) {
                continue;
            }

            $properties[$property] = $class::factory($properties[$property]);
        }

        return $properties;
    }
}

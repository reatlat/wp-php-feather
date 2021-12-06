<?php

/**
 * Class Feather_Icons
 * @fork https://github.com/Pixelrobin/php-feather
 * @link https://github.com/reatlat/wp-php-feather
 *
 * Feather_Icons::get('icon-name');
 */
if (!class_exists('Feather_Icons')) :
    class Feather_Icons
    {
        private $attributes;
        private $attributes_default;
        private static $_instance = null;


        public function __construct($attributes = array())
        {
            $this->attributes_default = array(
                'xmlns' => 'http://www.w3.org/2000/svg',
                'width' => '24',
                'height' => '24',
                'viewBox' => '0 0 24 24',
                'fill' => 'none',
                'stroke' => 'currentColor',
                'stroke-width' => '2',
                'stroke-linecap' => 'round',
                'stroke-linejoin' => 'round');

            $this->setAttributes($attributes, true);
        }


        public static function instance($attributes = array())
        {
            if (is_null(self::$_instance))
                self::$_instance = new self($attributes);

            return self::$_instance;
        }


        public static function get($name = '', $args = array())
        {
            $defaults = array(
                'before' => '<span class="%s">',
                'after' => '</span>',
                'class' => 'wp-feather-icon',
                'attributes' => array(),
                'echo' => true
            );

            $args = wp_parse_args($args, $defaults);

            $icon = '';

            if (!empty($name)) {
                $icon = sprintf($args['before'], $args['class'] . ' wp-feather-icon--' . $name);
                $icon .= self::instance($args['attributes'])->get_svg($name, $args['attributes'], false);
                $icon .= $args['after'];
            }

            if ($args['echo']) echo $icon;
            else return $icon;
        }


        public function get_svg($name, $attributes = array(), $echo = true)
        {
            $filepath = __DIR__ . '/icons/' . $name . '.svg';

            if (file_exists($filepath)) {

                $contents = file_get_contents($filepath);
                $attributes = array_merge($this->attributes, $attributes);

                if (isset($attributes['class'])) $class_end = ' ' . $attributes['class'];
                else $class_end = '';

                $attributes['class'] = 'feather feather-' . $name . $class_end;

                $dom_attributes = array_reduce(
                    array_keys($attributes),
                    function ($final, $current) use ($attributes) {
                        $attribute_value = $attributes[$current];

                        if (is_bool($attribute_value))
                            $attribute_value = $attribute_value ? 'true' : 'false';

                        return $final . $current . '="' . (string)$attribute_value . '" ';
                    }, ''
                );

                $icon = '<svg ' . $dom_attributes . '>' . $contents . '</svg>';

                if ($echo) echo $icon;
                else return $icon;
            }

            return false;
        }

        public function setAttributes($attributes, $merge = true)
        {
            if ($merge) $this->attributes = array_merge($this->attributes_default, $attributes);
            else $this->attributes = $attributes;
        }

        public function getAttributes()
        {
            return $this->attributes;
        }
    }
endif;
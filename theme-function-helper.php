<?php
/**
 * Display Feather icon
 *
 * @link https://github.com/reatlat/wp-php-feather
 */

//require_once 'class-feather-icons.php';

function your_theme_name_get_icon($name = '', $args = array())
{
    $defaults = array(
        'before' => '<span class="%s">',
        'after' => '</span>',
        'class' => 'your-theme-name-icon',
        'attributes' => array(),
        'echo' => true
    );

    $args = wp_parse_args( $args, $defaults );

    $icon = '';

    $icons = new Feather_Icons($args['attributes']);
    if (!empty($name)) {
        $icon = $icons->get_svg($name, $args['attributes'], false);
        $icon = sprintf($args['before'], $args['class'] . ' ' . $args['class'] . '--' . $name) . $icon . $args['after'];
    }

    if ($args['echo']) echo $icon;
    else return $icon;
}
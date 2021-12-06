<?php
/**
 * Display Feather icon
 *
 * @link https://github.com/reatlat/wp-php-feather
 */

require_once 'class-feather-icons.php';

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

    if (class_exists('Feather_Icons'))
        Feather_Icons::get($name, $args);
}
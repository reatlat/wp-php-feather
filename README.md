# wp-php-feather

Fork of PHP class https://github.com/Pixelrobin/php-feather

ready to use in any WordPress Theme or Plugin


## How to use

1. import `class-feather-icons.php` to your theme or plugin, for example to `/vendor/feather-icons` folder
2. add to `functions.php` line of code like `require_once dirname( __FILE__ )  . '/vendor/feather-icons/class-feather-icons.php';`

Use a static methood to get icon `Feather_Icons::get('menu');`


## Optional make helper function for your theme

Please check `theme-function-helper.php` file with function example.

<?php

namespace Dompdf;

class Autoloader
{
    /**
     * Register the autoloader.
     */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Autoload classes.
     *
     * @param string $class The class name.
     */
    public static function autoload($class)
    {
        if (strpos($class, 'Dompdf\\') === 0) {
            $file = __DIR__ . '/' . str_replace('\\', '/', substr($class, 7)) . '.php';
            if (is_file($file)) {
                require_once $file;
            }
        }
    }
}

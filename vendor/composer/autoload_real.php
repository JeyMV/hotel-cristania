<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb547e77607ce3d4636b860d0d503c689
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitb547e77607ce3d4636b860d0d503c689', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb547e77607ce3d4636b860d0d503c689', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb547e77607ce3d4636b860d0d503c689::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
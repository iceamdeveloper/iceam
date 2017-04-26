<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc72dbe2c83719617f5f7378becf872ec
{
    public static $classMap = array (
        'Aelia\\WC\\Cache_Handler\\Ajax_Loader_Cache_Handler' => __DIR__ . '/../..' . '/lib/classes/cache_handlers/ajax_loader_cache_handler.php',
        'Aelia\\WC\\Cache_Handler\\Base_Cache_Handler' => __DIR__ . '/../..' . '/lib/classes/cache_handlers/base_cache_handler.php',
        'Aelia\\WC\\Cache_Handler\\Cache_Handler_Cache_Handler' => __DIR__ . '/../..' . '/lib/classes/cache_handlers/cache_buster_cache_handler.php',
        'Aelia\\WC\\Cache_Handler\\Cache_Handler_Install' => __DIR__ . '/../..' . '/lib/classes/install/plugin-install.php',
        'Aelia\\WC\\Cache_Handler\\Definitions' => __DIR__ . '/../..' . '/lib/classes/definitions/definitions.php',
        'Aelia\\WC\\Cache_Handler\\Messages' => __DIR__ . '/../..' . '/lib/classes/messages/messages.php',
        'Aelia\\WC\\Cache_Handler\\Settings' => __DIR__ . '/../..' . '/lib/classes/settings/settings.php',
        'Aelia_WC_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-requirementscheck.php',
        'Cache_Handler_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/plugin-requirementscheck.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitc72dbe2c83719617f5f7378becf872ec::$classMap;

        }, null, ClassLoader::class);
    }
}
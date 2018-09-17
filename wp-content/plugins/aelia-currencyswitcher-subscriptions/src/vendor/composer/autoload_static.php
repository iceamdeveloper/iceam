<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85b43a7c77cfaa404dfa546bb86363a0
{
    public static $classMap = array (
        'Aelia\\WC\\CurrencySwitcher\\Subscriptions\\Definitions' => __DIR__ . '/../..' . '/lib/classes/definitions/definitions.php',
        'Aelia\\WC\\CurrencySwitcher\\Subscriptions\\Subscriptions_Integration' => __DIR__ . '/../..' . '/lib/classes/integration/woothemes-subscriptions-plugin/wc-aelia-cs-subscriptions-integration.php',
        'Aelia_WC_CS_Subscriptions_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-cs-subscriptions-requirementscheck.php',
        'Aelia_WC_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-requirementscheck.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit85b43a7c77cfaa404dfa546bb86363a0::$classMap;

        }, null, ClassLoader::class);
    }
}

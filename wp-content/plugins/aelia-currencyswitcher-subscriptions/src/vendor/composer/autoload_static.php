<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb10c4f4c100b317ecf65e7cdd8115283
{
    public static $classMap = array (
        'Aelia\\WC\\CurrencySwitcher\\Subscriptions\\Definitions' => __DIR__ . '/../..' . '/lib/classes/definitions/definitions.php',
        'Aelia\\WC\\CurrencySwitcher\\Subscriptions\\Subscriptions_Integration' => __DIR__ . '/../..' . '/lib/classes/integration/woothemes-subscriptions-plugin/wc-aelia-cs-subscriptions-integration.php',
        'Aelia_WC_CS_Subscriptions_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-cs-subscriptions-requirementscheck.php',
        'Aelia_WC_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-requirementscheck.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitb10c4f4c100b317ecf65e7cdd8115283::$classMap;

        }, null, ClassLoader::class);
    }
}

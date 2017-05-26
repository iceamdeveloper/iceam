<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfce4cce69bbb1a2c6d9480611c51e255
{
    public static $classMap = array (
        'Aelia\\WC\\CurrencySwitcher\\DynamicPricing\\Definitions' => __DIR__ . '/../..' . '/lib/classes/definitions/definitions.php',
        'Aelia\\WC\\CurrencySwitcher\\DynamicPricing\\Dynamic_Pricing_Integration' => __DIR__ . '/../..' . '/lib/classes/integration/woothemes-dynamic-pricing/woothemes-dynamic-pricing-integration.php',
        'Aelia_WC_CS_Dynamic_Pricing_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-cs-dynamic-pricing-requirementscheck.php',
        'Aelia_WC_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-requirementscheck.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitfce4cce69bbb1a2c6d9480611c51e255::$classMap;

        }, null, ClassLoader::class);
    }
}
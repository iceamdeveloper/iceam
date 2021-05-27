<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ec00a28341ba08d11bd1b948ea8e005
{
    public static $classMap = array (
        'Aelia\\WC\\CurrencySwitcher\\Bundles\\Bundles_Integration' => __DIR__ . '/../..' . '/lib/classes/integration/woothemes-bundles-plugin/wc-aelia-cs-bundles-integration.php',
        'Aelia\\WC\\CurrencySwitcher\\Bundles\\Definitions' => __DIR__ . '/../..' . '/lib/classes/definitions/definitions.php',
        'Aelia_WC_CS_Bundles_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-cs-bundles-requirementscheck.php',
        'Aelia_WC_RequirementsChecks' => __DIR__ . '/../..' . '/lib/classes/install/aelia-wc-requirementscheck.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit6ec00a28341ba08d11bd1b948ea8e005::$classMap;

        }, null, ClassLoader::class);
    }
}

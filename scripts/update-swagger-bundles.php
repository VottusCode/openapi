<?php

declare(strict_types = 1);

/**
 * Script that updates the Swagger bundles that are included in this package.
 *
 * When updating the bundles in this repository, please commit the bundles separately
 * (without any other changes to the project).
 *
 * This script requires NPM installed locally.
 */

const BundlesDir = __DIR__ . "/../src/UI/templates/bundles";
const SwaggerDistDir = __DIR__ . "/../node_modules/swagger-ui-dist";
const Bundles = [
    "swagger-ui-bundle.js",
    "swagger-ui-standalone-preset.js",
    "swagger-ui.css"
];

// Update Swagger UI to latest version.
echo shell_exec("npm update");

if (file_exists(BundlesDir)) {
    if (!is_dir(BundlesDir)) {
        throw new Exception(BundlesDir . " is not a directory.");
    }

    array_map( 'unlink', array_filter((array) glob(BundlesDir . "/*")));
    rmdir(BundlesDir);
}

mkdir(BundlesDir);

foreach (Bundles as $bundleName) {
    $bundlePath = SwaggerDistDir . "/{$bundleName}";
    $distPath = BundlesDir . "/{$bundleName}";

    echo "{$bundlePath} -> {$distPath}\n";

    if (!file_exists($bundlePath)) {
        throw new Exception("{$bundleName} not found in " . SwaggerDistDir);
    }

    copy($bundlePath, $distPath);
}



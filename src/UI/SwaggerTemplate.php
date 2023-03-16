<?php

declare(strict_types=1);

namespace Liliana\OA\UI;

/**
 * Helper data-class for the Swagger UI HTML template.
 */
class SwaggerTemplate
{
    public function __construct(
        public readonly array $spec = [],
        public readonly array $scripts = [],
        public readonly array $styles = [],
        public readonly string $mount = "#swagger-root",
        public readonly string $title = "Swagger UI",
        public readonly ?string $url = null,
        public readonly string|bool $filter = true,
        public readonly ?string $docExpansion = DocExpansionMode::List
    )
    {
    }

    public function readBundle(string $bundlePath): ?string
    {
        if (!file_exists($bundlePath) || !is_readable($bundlePath)) {
            trigger_error("Bundle {$bundlePath} does not exists or is not readable.");
            return null;
        }

        return file_get_contents($bundlePath);
    }

}
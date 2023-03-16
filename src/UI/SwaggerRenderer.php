<?php

declare(strict_types=1);

namespace Liliana\OA\UI;

use Liliana\OA\Spec\SpecProviderInterface;

/**
 * Renderer for the Swagger UI HTML.
 */
class SwaggerRenderer
{
    public const SwaggerUiScripts = [
        __DIR__ . "/templates/bundles/swagger-ui-bundle.js",
        __DIR__ . "/templates/bundles/swagger-ui-standalone-preset.js",
    ];

    public const SwaggerUiStyles = [
        __DIR__ . "/templates/bundles/swagger-ui.css"
    ];

    public const SwaggerFullTemplate = __DIR__ . "/templates/template-full.phtml";

    public const SwaggerMinimalTemplate = __DIR__ . "/templates/template-minimal.phtml";

    private string $mount = "#swagger-root";

    private string $title = "Swagger UI";

    private ?string $url = null;

    private string|bool $filter = true;

    private ?string $docExpansion = DocExpansionMode::List;

    public function __construct(
        private readonly SpecProviderInterface $specProvider
    )
    {
    }

    /**
     * @param string $mount
     */
    public function setMount(string $mount): void
    {
        $this->mount = $mount;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param bool|string $filter
     */
    public function setFilter(bool|string $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @param string|null $docExpansion
     */
    public function setDocExpansion(?string $docExpansion): void
    {
        $this->docExpansion = $docExpansion;
    }

    /**
     * Renders a full HTML for Swagger UI into a string.
     * This is useful for specific endpoints only intended for Swagger,
     * where the result of this function can be passed as a response.
     *
     * If you only want to include Swagger UI as a part of an existing page,
     * consider using {@see SwaggerRenderer::renderMinimal()} instead.
     *
     * When using this function, it is important that {@see SwaggerRenderer::$mount}
     * is set to a simple id, eg. #swagger-root, otherwise the root element will be
     * created incorrectly and Swagger won't be able to mount.
     *
     * @return string
     */
    public function renderFull(): string
    {
        ob_start();

        $template = $this->createTemplate();
        require self::SwaggerFullTemplate;

        return (string) ob_get_clean();
    }

    public function renderMinimal(): string
    {
        ob_start();

        $template = $this->createTemplate();
        require self::SwaggerMinimalTemplate;

        return (string) ob_get_clean();
    }

    private function createTemplate(): SwaggerTemplate
    {
        return new SwaggerTemplate(
            spec: $this->specProvider->provide(),
            scripts: self::SwaggerUiScripts,
            styles: self::SwaggerUiStyles,
            mount: $this->mount,
            title: $this->title,
            url: $this->url,
            filter: $this->filter,
            docExpansion: $this->docExpansion
        );
    }


}
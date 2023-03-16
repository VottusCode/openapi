<?php

declare(strict_types=1);

namespace Liliana\OA\Spec;

use OpenApi\Generator;

/**
 * This provider generates a specification based on annotations/attributes
 * using a library zircote/swagger-php (and it's annotations).
 */
class AnnotationSpecProvider implements SpecProviderInterface
{
    /**
     * @param string[] $paths Paths to scan for spec generation
     * @param array $options Options for {@see Generator}.
     */
    public function __construct(
        private readonly array $paths,
        private readonly array $options
    )
    {
    }

    public function provide(): object
    {
        $oa = Generator::scan($this->paths, $this->options);
        return $oa->jsonSerialize();
    }
}
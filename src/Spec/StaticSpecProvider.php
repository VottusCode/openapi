<?php

declare(strict_types=1);

namespace Liliana\OA\Spec;

/**
 * Simple provider with a static specification.
 */
class StaticSpecProvider implements SpecProviderInterface
{
    public function __construct(
        private readonly object $spec
    )
    {
    }

    public function provide(): object
    {
        return $this->spec;
    }
}
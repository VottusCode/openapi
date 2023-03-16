<?php

declare(strict_types=1);

namespace Liliana\OA\Spec;

use JsonSerializable;

/**
 * Simple provider with a static specification.
 */
class StaticSpecProvider implements SpecProviderInterface
{
    public function __construct(
        private readonly JsonSerializable $spec
    )
    {
    }

    public function provide(): JsonSerializable
    {
        return $this->spec;
    }
}
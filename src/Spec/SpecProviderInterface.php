<?php

declare(strict_types=1);

namespace Liliana\OA\Spec;

use JsonSerializable;

/**
 * Interface for providing OpenAPI specifications.
 */
interface SpecProviderInterface
{

    /**
     * Provide the OpenAPI specification.
     *
     * @return JsonSerializable
     */
    public function provide(): JsonSerializable;

}
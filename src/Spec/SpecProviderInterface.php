<?php

declare(strict_types=1);

namespace Liliana\OA\Spec;

/**
 * Interface for providing OpenAPI specifications.
 */
interface SpecProviderInterface
{

    /**
     * Provide the OpenAPI specification.
     *
     * @return object
     */
    public function provide(): object;

}
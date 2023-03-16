<?php

declare(strict_types=1);

namespace Liliana\OA\UI;

/**
 * Valid values for the `docExpansion` parameter in Swagger UI.
 * {@see https://swagger.io/docs/open-source-tools/swagger-ui/usage/configuration/#display}
 */
class DocExpansionMode
{
    public const
        Full = 'full',
        List = 'list',
        None = 'none';

}
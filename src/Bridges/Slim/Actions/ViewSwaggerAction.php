<?php

declare(strict_types=1);

namespace Liliana\OA\Bridges\Slim\Actions;

use Exception;
use Liliana\OA\Spec\SpecProviderInterface;
use Liliana\OA\UI\SwaggerRenderer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ViewSwaggerAction
{
    public function __construct(
        private readonly SwaggerRenderer $swaggerRenderer
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write($this->swaggerRenderer->renderFull());

        return $response
            ->withHeader('Content-Type', 'text/html');
    }

}
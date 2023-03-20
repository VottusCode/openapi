<?php

declare(strict_types=1);

namespace Liliana\OA\Bridges\Slim\Actions;

use Exception;
use Liliana\OA\Spec\SpecProviderInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ViewSpecAction
{
    public function __construct(
        private readonly SpecProviderInterface $specProvider
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $json = json_encode($this->specProvider->provide(), JSON_PRETTY_PRINT);

        if (!$json) {
            throw new Exception("Cannot serialize OpenAPI specification.");
        }

        $response->getBody()->write($json);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

}
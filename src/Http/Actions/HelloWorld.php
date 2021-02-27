<?php

namespace App\Http\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HelloWorld
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('Hello world');
        
        return $response;
    }
}
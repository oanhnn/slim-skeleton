<?php

use App\Http\Actions\HelloWorld;

/**@var \Slim\App $app */

// Register example routes
$app->get('/hello-world', HelloWorld::class)->setName('hello-world');

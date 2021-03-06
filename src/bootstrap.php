<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

// Create the application
$app = new Application();

// Register Silex extensions
//$app->register(new MyAwesomeExtension());

// Add services to the DI container
//$app['my.service'] = function() {
//    // ...
//    return new My\Service();
//};
//$app['my.shared_service'] = $app->share(function() {
//    // ...
//    return new My\SharedService();
//});

// Configuration parameters
$app['debug'] = false;
//$app['my.param'] = '...';

// Override settings for your dev environment
$env = isset($_ENV['SILEX_ENV']) ? $_ENV['SILEX_ENV'] : 'dev';

if ('dev' == $env) {
    $app['debug'] = true;
    //$app['my.param'] = '...';
}

// Error handling
$app->error(function (\Exception $ex, $code) use ($app) {

    if ($app['debug']) {
        return;
    }

    if (404 == $code) {
        return new Response(file_get_contents(__DIR__.'/../web/404.html'));
    } else {
        // Do something more sophisticated here (logging etc.)
        return new Response('<h1>Error!</h1>');
    }

});

return $app;

<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// view renderer with Twig

$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \Slim\Views\Twig($settings['template_path']);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// eloquent
$container['db'] = function ($c) {
    $manager = new \Illuminate\Database\Capsule\Manager;
    $manager->addConnection($c->get('settings')['db']);
    $manager->setAsGlobal();
    $manager->bootEloquent();
    return $manager->getConnection('default');
};

$container['db'];

//errorHandler
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $code = 500;
        if (is_a($exception, 'App\Exceptions\HttpException')) {
            $code = $exception->getStatusCode();
        }
        return $c['response']->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->write($exception->getMessage());
    };
};

$container['secretKey'] = function ($c) {
    return $c->get('settings')['secret'];
};

//adr
$container['pages_domain'] = function ($c) {
    return new App\Pages\Domain;
};
$container['pages_responder'] = function ($c) {
    return new App\Pages\Responder;
};

$container['posts_domain'] = function ($c) {
    return new App\Posts\Domain;
};
$container['posts_responder'] = function ($c) {
    return new App\Posts\Responder;
};

$container['users_domain'] = function ($c) {
    return new App\Users\Domain;
};
$container['users_responder'] = function ($c) {
    return new App\Users\Responder;
};

<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once (__DIR__.'/../boot.php');


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Controllers\Index.home');
    $r->addRoute('GET', '/{page:[1-9]+}', 'Controllers\Index.paginate');
    $r->addRoute('GET', '/login', 'Controllers\Auth.login');
    $r->addRoute('POST', '/login', 'Controllers\Auth.check');
    $r->addRoute('POST', '/logout', 'Controllers\Auth.logout');
    $r->addRoute('GET', '/new', 'Controllers\Task.new');
    $r->addRoute('POST', '/post', 'Controllers\Task.post');
    $r->addRoute('POST', '/update', 'Controllers\Task.update');
    $r->addRoute('POST', '/done', 'Controllers\Task.done');

});

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

View\View::setRequest($request);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getRequestTarget());

try{

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        throw new Exceptions\NotFoundException();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        throw new Exceptions\NotAllowedException();
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = explode(".", $routeInfo[1]);
        $controller_params = $routeInfo[2];
        break;
};

    $controller = new $handler[0];

    $controller->{$handler[1]}($request, $controller_params);

}catch (Exception $e){
    // записать в лог
    Exceptions\Handler::handle( $e );
}
exit;
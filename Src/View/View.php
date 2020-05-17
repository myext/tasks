<?php


namespace View;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;

class View
{
    protected static $request;

    public static function setRequest( ServerRequest $request )
    {
        self::$request = $request;
    }

    public static function flush( $params = [], $status = 200, $view = 'default')
    {
        if(self::isAjax()){
            $response = new JsonResponse($params, $status, [
                'Content-Type' => [ 'application/json', 'charset=utf-8' ],]);
        }else{

            ob_start();

            extract($params);

            require_once (ROOT_DIR.'/views/'.$view.'.php');

            $html = ob_get_clean();

            $response = new HtmlResponse($html, $status, [
                'Content-Type' => [ 'text/html', 'charset=utf-8' ],
            ]);
        }

        self::render($response);
    }

    protected static function isAjax()
    {
        $serverParams = self::$request->getServerParams();

        return ( isset($serverParams['HTTP_X_REQUESTED_WITH']) &&
            !empty($serverParams['HTTP_X_REQUESTED_WITH']) &&
            strtolower($serverParams['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    protected static function render($response)
    {
        header('HTTP/'.$response->getProtocolVersion(). ' ' .$response->getStatusCode() . ' ' . $response->getReasonPhrase());

        foreach ($response->getHeaders() as $header => $value) {
            header($header.': '.implode("; ", $value));
        }
        echo $response->getBody()->getContents();
    }

}
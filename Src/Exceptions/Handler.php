<?php


namespace Exceptions;


class Handler
{
    public static function handle(\Exception $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundException:
                view(['message' => 'not found'], 404, '404');
                break;

            case $exception instanceof NotAllowedException:
                view(['message' => 'not allowed'], 405, '405');
                break;

            case $exception instanceof UnauthorizedException:
                view(['message' => 'Пройдите авторизацию'], 401, '401');
                break;

            default:
                view(['message' => 'server error'], 500, '500');
        }

    }

}
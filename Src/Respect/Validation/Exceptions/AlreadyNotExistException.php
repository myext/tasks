<?php


namespace Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class AlreadyNotExistException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Object already not exist in db.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '',
        ],
    ];

}
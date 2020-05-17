<?php


namespace Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class AlreadyExistException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Object already exist in db.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '',
        ],
    ];

}
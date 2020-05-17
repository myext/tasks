<?php


namespace Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

final class AlreadyExist extends AbstractRule
{
    public function validate($input): bool
    {
        $model = $input['repository']->where([$input['field'] => $input['value']])->first();

        if( $model === false ) return true;

        return false;
    }
}
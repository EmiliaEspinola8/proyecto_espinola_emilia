<?php

namespace App\Validation;

class CustomRules
{
    public function todosCompletos(array $value): bool
    {
        foreach ($value as $v) {
            if ($v === '' || $v === null) {
                return false;
            }
        }
        return true;
    }
}
<?php

use Illuminate\Validation\Validator;

if (! function_exists('empty_validator')) {
    /**
     * Check if the validator is empty.
     */
    function empty_validator(Validator $validator): bool
    {
        return empty($validator->errors()->toArray());
    }
}
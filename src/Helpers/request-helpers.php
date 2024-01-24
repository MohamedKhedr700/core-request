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

if (! function_exists('check_strings_in_array')) {
    /**
     * Determine if each value in array is string.
     */
    function check_strings_in_array(array $array): bool
    {
        return array_sum(array_map('is_string', $array)) == count($array);
    }
}

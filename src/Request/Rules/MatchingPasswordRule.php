<?php

namespace Raid\Core\Request\Http\Requests\Rules;

use Illuminate\Validation\Validator;
use Modules\Account\Contracts\AccountInterface;

class MatchingPasswordRule
{
    private ?AccountInterface $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = user();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     */
    public function passes(string $attribute, $value, $parameters, Validator $validator): bool
    {
        if (! $this->user || ! $this->user->isMatchingPassword($value)) {
            $validator->errors()->add($attribute, trans('validation.matching_password', ['attribute' => trans("validation.attributes.${attribute}")]));

            return false;
        }

        return true;
    }
}

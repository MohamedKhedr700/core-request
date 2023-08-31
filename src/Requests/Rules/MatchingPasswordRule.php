<?php

namespace Raid\Core\Request\Requests\Rules;

use Illuminate\Validation\Validator;
use Modules\Account\Contracts\AccountInterface;

class MatchingPasswordRule
{
    /**
     * Account instance.
     */
    private ?object $account;

    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        $this->account = auth()->check() ? account() : null;
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes(string $attribute, $value, $parameters, Validator $validator): bool
    {
        if (! $this->account || ! $this->account->isMatchingPassword($value)) {
            $validator->errors()->add($attribute, trans('validation.matching_password', [
                'attribute' => trans("validation.attributes.$attribute"),
            ]));

            return false;
        }

        return true;
    }
}

<?php

namespace Raid\Core\Request\Traits\Request;

use Illuminate\Validation\Validator;

trait WithCommonRules
{
    /**
     * Before validation.
     */
    public function prepareForValidation(): void
    {
    }

    /**
     * Define common Rules.
     */
    public function commonRules(): array
    {
        return [];
    }

    /**
     * Define attributes localization.
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * After validation.
     */
    public function withValidator(Validator $validator): void
    {
        if (! empty_validator($validator)) {
            return;
        }

        $validator->after(function () {
        });
    }
}

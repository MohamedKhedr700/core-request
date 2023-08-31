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
        if (! empty($validator->errors()->toArray())) {
            return;
        }

        $validator->after(function () {
        });
    }
}

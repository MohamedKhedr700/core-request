<?php

namespace Raid\Core\Request\Requests;

use Illuminate\Foundation\Http\FormRequest as IlluminateFormRequest;
use Raid\Core\Request\Traits\Request\WithRequestRoute;
use Raid\Core\Request\Traits\Request\WithRequestRule;

abstract class FormRequest extends IlluminateFormRequest
{
    use WithRequestRoute,
        WithRequestRule;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the common rules between form requests.
     */
    public function commonRules(): array
    {
        return [];
    }

    /**
     * Merge the given rules with the common rules between store and update.
     */
    public function withCommonRules(array $rules = []): array
    {
        $commonRules = $this->commonRules();

        $accountTypeRules = $this->getAccountTypeRules();

        return $this->mergeRules($rules, $commonRules, $accountTypeRules);
    }

    /**
     * Merge the given rules with the common rules between store and update.
     */
    public function withOnlyCommonRules(array $rules = []): array
    {
        if (empty($rules)) {
            return [];
        }

        $commonRules = array_intersect_key($this->commonRules(), $rules);

        $accountTypeRules = array_intersect_key($this->getAccountTypeRules(), $rules);

        return $this->combineRules($rules, $commonRules, $accountTypeRules);
    }

    /**
     * Get the validation rules that apply to the account type.
     */
    public function getAccountTypeRules(): array
    {
        if (! auth()->check()) {

            return [];
        }

        $accountType = account()->accountType() ?? null;

        if (! $accountType) {
            return [];
        }

        $method = $accountType.'Rules';

        if (! method_exists($this, $method)) {
            return [];
        }

        return $this->{$method}();
    }
}

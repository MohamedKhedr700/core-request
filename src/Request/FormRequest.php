<?php

namespace Raid\Core\Request\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Account\Models\Account;
use Modules\User\Models\User;
use Raid\Core\Request\Traits\Request\WithFormRequestHelper;
use Raid\Core\Request\Traits\Request\WithRequestRoute;
use Raid\Core\Request\Traits\Response\ResponseBuilder;

abstract class FormRequest extends BaseFormRequest
{
    use WithFormRequestHelper,
        WithRequestRoute;

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
        
        $account = account();

        if (! $account) {
            return [];
        }

        $method = account()->accountType().'Rules';

        if (! method_exists($this, $method)) {
            return [];
        }

        return $this->{$method}();
    }
}

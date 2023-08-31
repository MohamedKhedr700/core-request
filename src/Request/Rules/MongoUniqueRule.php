<?php

namespace Raid\Core\Request\Http\Requests\Rules;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class MongoUniqueRule
{
    /**
     * The parameters.
     */
    protected array $parameters = [
        'table', 'column',
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @throws Exception
     */
    public function passes(string $attribute, $value, $parameters, Validator $validator): bool
    {
        $parameters = $this->prepareParameters($parameters);

        $checkUniqueValue = $this->checkUniqueValue($value, ...$parameters);

        if ($checkUniqueValue) {
            $validator->errors()->add($attribute, trans('validation.unique', ['attribute' => trans("validation.attributes.$attribute")]));

            return false;
        }

        return true;
    }

    /**
     * Prepare the required parameters and combine the parameters.
     *
     * @throws Exception
     */
    private function prepareParameters(array $parameters = []): array
    {
        if (count($this->parameters) > count($parameters)) {
            throw new Exception('Theses parameters is missing '.implode(',', array_diff_key($this->parameters, $parameters)));
        }

        if (isset($parameters[2])) {
            $this->parameters[] = 'ignoreValue';
        }

        if (isset($parameters[3])) {
            $this->parameters[] = 'ignoreColumn';
        }

        $this->parameters = array_combine($this->parameters, $parameters);

        return $this->parameters;
    }

    /**
     * Check unique value.
     */
    private function checkUniqueValue(string $value, string $table, string $column, string $ignoreValue = null, string $ignoreColumn = null): bool
    {
        return (bool) DB::table($table)
            ->where($column, $value)
            ->where('id', '!=', $ignoreValue)
            ->count();
    }
}

<?php

namespace Raid\Core\Request\Traits\Request;

trait WithRequestRule
{
    /**
     * Get the pagination rules that apply to the request.
     */
    public function mergeRules(array $rules, array $commonRules, array $accountTypeRules): array
    {
        $mergeRules = array_merge_recursive($rules, $commonRules, $accountTypeRules);

        foreach ($mergeRules as $key => $value) {
            $mergeRules[$key] = array_values(array_unique($value));
        }

        return $mergeRules;
    }

    /**
     * Combine the given rules with the common rules between store and update.
     */
    public function combineRules(array $rules, array $commonRules, array $accountTypeRules): array
    {
        array_walk($rules, function (&$value, $key) use ($commonRules, $accountTypeRules, &$allRules) {
            $keyCommonRules = $commonRules[$key] ?? [];

            $keyAccountTypeRules = $accountTypeRules[$key] ?? [];

            $value = array_values(array_unique(array_merge($value, $keyCommonRules, $keyAccountTypeRules)));

            $allRules[$key] = $value;
        });

        return $allRules;
    }
}

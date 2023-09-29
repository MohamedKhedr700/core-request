<?php

namespace Raid\Core\Request\Traits\Requests;

trait WithPaginationCommonRules
{
    /**
     * Get the pagination rules that apply to the request.
     */
    public function paginationRules(): array
    {
        return [
            'page' => ['nullable', 'integer'],
            'perPage' => ['nullable', 'integer'],
            'search' => ['nullable', 'string'],
            'orderBy' => ['nullable', 'string'],
            'direction' => ['nullable', 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function withCommonRules(array $rules = []): array
    {
        $rules = array_merge_recursive($this->paginationRules(), $rules);

        return parent::withCommonRules($rules);
    }
}

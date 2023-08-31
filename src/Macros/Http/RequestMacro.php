<?php

namespace Raid\Core\Macros\Http;

use Closure;
use Raid\Core\Request\Exceptions\Request\UnvalidatedRequestException;

class RequestMacro
{
    /**
     * Get only the validated data from the request.
     */
    public function onlyValidated(): Closure
    {
        return function (): array {
            if (! method_exists($this, 'validated')) {
                throw new UnvalidatedRequestException('Request must be validated to access it\'s data.');
            }

            return $this->validated();
        };
    }
}
<?php

namespace Raid\Core\Request\Traits\Request;

use Raid\Core\Request\Models\Contracts\ModelInterface;

trait WithRequestRoute
{
    /**
     * The route original id.
     */
    private static ?string $routeId;

    /**
     * The route model binding.
     */
    private static ?ModelInterface $routeModel;

    /**
     * Get route original id parameter.
     */
    public function getRouteId(): ?string
    {
        if (! isset(static::$routeId)) {
            static::$routeId = $this->route()->originalParameter('id');
        }

        return static::$routeId;
    }

    /**
     * Get the route model binding.
     */
    public function getRouteModel(): ?ModelInterface
    {
        if (! isset(static::$routeModel)) {
            $id = $this->route('id');

            static::$routeModel = $id instanceof ModelInterface ? $id : null;
        }

        return static::$routeModel;
    }
}

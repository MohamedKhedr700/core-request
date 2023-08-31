<?php

namespace Raid\Core\Request\Traits\Request;


trait WithRequestRoute
{
    /**
     * The route original id.
     */
    private static ?string $routeId;

    /**
     * The route model binding.
     */
    private static ?object $routeModel;

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
    public function getRouteModel(): ?object
    {
        if (! isset(static::$routeModel)) {
            $id = $this->route('id');

            static::$routeModel = is_object($id) ? $id : null;
        }

        return static::$routeModel;
    }

    /**
     * Get route parameter value.
     */
    public function getRoute(string $key, mixed $default = null, $original = false): mixed
    {
        return $original ? $this->route()->originalParameter($key, $default) : $this->route($key, $default);
    }
}

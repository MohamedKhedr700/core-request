<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Rules
    |--------------------------------------------------------------------------
    |
    | Here you can define the custom validation rules that will be used in the application.
    |
    */

    'custom_rules' => [
        'localized' => \Raid\Core\Request\Requests\Rules\LocalizedRule::class,
        'matching_password' => \Raid\Core\Request\Requests\Rules\MatchingPasswordRule::class,
        'mongo_unique' => \Raid\Core\Request\Requests\Rules\MongoUniqueRule::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Macros
    |--------------------------------------------------------------------------
    | Here you may specify which macros you would like to register when the
    | application boots.
    | Macros are great for extending Laravel core
    | classes without touching the original class in your project.
    |
    |
    */

    'macros' => [
        Illuminate\Http\Request::class => Raid\Core\Request\Macros\Http\RequestMacro::class,
    ],
];

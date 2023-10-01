# Core Request Package

This package is responsible for handling all requests in the system.

## Installation

``` bash
composer require raid/core-request
```

## Configuration

``` bash
php artisan core:publish-request
```


## Usage

``` php
use App\Traits\Request\WithUserCommonRules;
use Raid\Core\Request\Requests\FormRequest;

class CreateUserRequest extends FormRequest
{
    use WithUserCommonRules;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return $this->withCommonRules();
    }
}
```

# How to work this

Let's start with our request class `CreateUserRequest`.

you can use the command `php artisan core:make-request CreateUserRequest` to create the request class.

``` php
<?php

namespace App\Http\Requests;

use Raid\Core\Request\Requests\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [];
    }
}
```

This looks like a normal request class, but it's not it just needs some helper.

Let's create our `common-rules-request` trait.

you can use the command `php artisan core:make-common-request WithUserCommonRules` to create the common request trait.

``` php
<?php

namespace App\Traits\Request;

trait WithUserCommonRules
{
    /**
     * Get the common rules for the user.
     */
    public function commonRules(): array
    {
        return [];
    }

    /**
     * Get the common attributes for the user.
     */
    public function attributes(): array
    {
        return [];
    }
}
```

The `commonRules` method is responsible for returning the common rules for the requests.

you can define the rules that are common for your requests and only the rules,
never-mind about the keys as we will see later.

``` php
<?php

namespace App\Traits\Request;

trait WithUserCommonRules
{
    /**
     * Get the common rules for the user.
     */
    public function commonRules(): array
    {
        return [
            'name' => ['string', 'min:2', 'max:255'],
        ];
    }

    /**
     * Get the common attributes for the user.
     */
    public function attributes(): array
    {
        return [
            'name' => __('attributes.name'),
        ];
    }
}
```

Here we have defined only common rules for name, and that will be inherited by all requests that use this trait.

We also can define the unique rules for the request for same attribute.

Now let's go back to our request classes.

``` php
<?php

namespace App\Http\Requests;

use Raid\Core\Request\Requests\FormRequest;
use App\Traits\Request\WithUserCommonRules;

class CreateUserRequest extends FormRequest
{
    use WithUserCommonRules;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return $this->withCommonRules([
            'name' => ['required'],
        ]);
    }
}
```

``` php
<?php

namespace App\Http\Requests;

use Raid\Core\Request\Requests\FormRequest;
use App\Traits\Request\WithUserCommonRules;

class UpdateUserRequest extends FormRequest
{
    use WithUserCommonRules;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return $this->withCommonRules([
            'name' => ['sometimes'],
        ]);
    }
}
```

Now both requests inherit the common rules and attributes for name and all the common rules defined, and each one has its own rules as well.

The `withCommonRules` method is responsible for merging the common rules with the request rules.

The `withCommonRules` method accepts an array of rules, and it will merge it with the common rules.

We have another method called `withOnlyCommonRules` which is responsible for merging only the given key with the common rules for that key.

``` php
<?php

namespace App\Http\Requests;

use Raid\Core\Request\Requests\FormRequest;
use App\Traits\Request\WithUserCommonRules;

class CreateUserRequest extends FormRequest
{
    use WithUserCommonRules;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return $this->withOnlyCommonRules([
            'name' => ['required'],
        ]);
    }
}
```

This will merge only the name rules with the common rules for name, and ignore all other common keys if defined.

And that's it.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [MohamedKhedr]()

## Security

If you discover any security-related issues, please email
instead of using the issue tracker.

## About Raid

Raid is a PHP framework created by [MohamedKhedr700]()
and is maintained by [MohamedKhedr700]().

## Support Raid

Raid is an MIT-licensed open-source project. It's an independent project with its ongoing development made possible.


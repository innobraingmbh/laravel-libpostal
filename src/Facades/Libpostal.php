<?php

declare(strict_types=1);

namespace Innobrain\Libpostal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Innobrain\Libpostal\Libpostal
 */
class Libpostal extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Innobrain\Libpostal\Libpostal::class;
    }
}

<?php

declare(strict_types=1);

namespace Innobrain\Libpostal\Facades;

use Illuminate\Support\Facades\Facade;
use Innobrain\Libpostal\Dtos\ParsedAddress;

/**
 * @see \Innobrain\Libpostal\Libpostal
 *
 * @method static ParsedAddress parseAddress(string $address)
 */
class Libpostal extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Innobrain\Libpostal\Libpostal::class;
    }
}

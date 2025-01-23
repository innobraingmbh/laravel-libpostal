<?php

declare(strict_types=1);

namespace Innobrain\Libpostal\Dtos\Concerns;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionParameter;

trait Fromable
{
    public static function fromArray(array $data): static
    {
        $parameters = static::getParameters();

        $countedParameters = $parameters->count();
        $countedData = count($data);

        throw_if($countedParameters !== $countedData, new InvalidArgumentException("Expected $countedParameters parameters, but got $countedData"));

        $data = $parameters
            ->mapWithKeys(fn (string $parameter) => [$parameter => data_get($data, $parameter)])
            ->toArray();

        /* @phpstan-ignore-next-line */
        return new static(...$data);
    }

    protected static function getParameters(): Collection
    {
        $reflection = new ReflectionClass(static::class);
        $parameters = $reflection->getConstructor()?->getParameters();

        return collect($parameters)
            ->map(fn (ReflectionParameter $parameter) => $parameter->getName());
    }
}

<?php

declare(strict_types=1);

namespace Innobrain\Libpostal\Dtos;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Innobrain\Libpostal\Dtos\Concerns\Fromable;

final class ParsedAddress
{
    use Fromable;

    public function __construct(
        public string $house = '',
        public string $category = '',
        public string $near = '',
        public string $houseNumber = '',
        public string $road = '',
        public string $unit = '',
        public string $level = '',
        public string $staircase = '',
        public string $entrance = '',
        public string $poBox = '',
        public string $postcode = '',
        public string $suburb = '',
        public string $cityDistrict = '',
        public string $city = '',
        public string $island = '',
        public string $stateDistrict = '',
        public string $state = '',
        public string $countryRegion = '',
        public string $country = '',
        public string $worldRegion = '',
    ) {}

    public static function make(...$args): ParsedAddress
    {
        return new ParsedAddress(...$args);
    }

    public static function fromLibpostalResponse(array $data): self
    {
        $mappedData = collect($data)
            ->mapWithKeys(function (array $item) {
                $key = Str::camel($item[1]);
                $value = $item[0];

                return [$key => $value];
            });

        $parameters = self::getParameters();

        $parameters
            ->mapWithKeys(fn (string $parameter) => [$parameter => ''])
            ->diffKeys($mappedData)
            ->each(fn (string $value, string $key) => $mappedData->put($key, $value));

        $mappedData = $mappedData
            ->sortBy(fn (string $value, string $key) => $parameters->search($key))
            ->toArray();

        return self::fromArray($mappedData);
    }

    public function toHttpResponse(): PromiseInterface
    {
        $data = self::getParameters()
            ->map(fn (string $parameter) => [Str::lower($this->$parameter), Str::snake($parameter)])
            ->toArray();

        return Http::response($data);
    }
}

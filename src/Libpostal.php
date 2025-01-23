<?php

declare(strict_types=1);

namespace Innobrain\Libpostal;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Innobrain\Libpostal\Dtos\ParsedAddress;
use Innobrain\Libpostal\Exceptions\InvalidConfigException;

class Libpostal
{
    protected string $url;

    /**
     * @throws InvalidConfigException
     */
    public function __construct()
    {
        $this->url = Config::get('libpostal.url');

        if (empty($this->url)) {
            throw new InvalidConfigException('Libpostal URL is not set');
        }
    }

    protected function getUrl(): string
    {
        return str($this->url)
            ->chopEnd('?')
            ->chopEnd('/')
            ->append('/')
            ->append('parse')
            ->append('?')
            ->toString();
    }

    public function parseAddress(string $address): ParsedAddress
    {
        $queryParameter = http_build_query(['address' => $address]);
        $url = $this->getUrl().$queryParameter;

        $response = Http::get($url)->json();

        return ParsedAddress::fromLibpostalResponse($response);
    }
}

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Innobrain\Libpostal\Exceptions\InvalidConfigException;
use Innobrain\Libpostal\Libpostal;

describe('construct', function () {
    test('will throw error if url is missing', function () {
        Config::set('libpostal.url', '');

        new Libpostal;
    })->throws(InvalidConfigException::class, 'Libpostal URL is not set');

    test('will construct', function () {
        Config::set('libpostal.url', 'http://localhost:8080');

        new Libpostal;
    })->throwsNoExceptions();
});

describe('parse address', function () {
    test('will parse address', function () {
        $libpostal = new Libpostal;

        Http::preventStrayRequests();
        Http::fake([
            'http://localhost:8080/parse?address=*' => Http::response([
                ['123', 'house_number'],
                ['main st', 'road'],
                ['springfield', 'city'],
                ['il', 'state'],
                ['62701', 'postcode'],
            ]),
        ]);

        $response = $libpostal->parseAddress('123 Main St, Springfield, IL 62701');

        expect($response->houseNumber)->toBe('123')
            ->and($response->road)->toBe('main st')
            ->and($response->city)->toBe('springfield')
            ->and($response->state)->toBe('il')
            ->and($response->postcode)->toBe('62701');
    });
});

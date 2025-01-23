<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Innobrain\Libpostal\Dtos\ParsedAddress;

it('can construct', function () {
    $data = [
        ['123', 'house_number'],
        ['main st', 'road'],
        ['springfield', 'city'],
        ['il', 'state'],
        ['62701', 'postcode'],
    ];

    $parsedAddress = ParsedAddress::fromLibpostalResponse($data);

    expect($parsedAddress->houseNumber)->toBe('123')
        ->and($parsedAddress->road)->toBe('main st')
        ->and($parsedAddress->city)->toBe('springfield')
        ->and($parsedAddress->state)->toBe('il')
        ->and($parsedAddress->postcode)->toBe('62701');
});

it('can turn to response', function () {
    Http::preventStrayRequests();
    Http::fake([
        '*' => ParsedAddress::make(country: 'US')->toHttpResponse(),
    ]);

    $response = Http::get('https://example.com');

    expect($response->json())->toBe([
        [
            '',
            'house',
        ],
        [
            '',
            'category',
        ],
        [
            '',
            'near',
        ],
        [
            '',
            'house_number',
        ],
        [
            '',
            'road',
        ],
        [
            '',
            'unit',
        ],
        [
            '',
            'level',
        ],
        [
            '',
            'staircase',
        ],
        [
            '',
            'entrance',
        ],
        [
            '',
            'po_box',
        ],
        [
            '',
            'postcode',
        ],
        [
            '',
            'suburb',
        ],
        [
            '',
            'city_district',
        ],
        [
            '',
            'city',
        ],
        [
            '',
            'island',
        ],
        [
            '',
            'state_district',
        ],
        [
            '',
            'state',
        ],
        [
            '',
            'country_region',
        ],
        [
            'us',
            'country',
        ],
        [
            '',
            'world_region',
        ],
    ]);
});

<?php

declare(strict_types=1);

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

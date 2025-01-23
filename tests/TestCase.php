<?php

declare(strict_types=1);

namespace Innobrain\Libpostal\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Innobrain\Libpostal\LibpostalServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            static fn (string $modelName) => 'Innobrain\\Libpostal\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            LibpostalServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}

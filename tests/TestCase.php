<?php

namespace Smpita\MakeAs\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Smpita\MakeAs\MakeAsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MakeAsServiceProvider::class,
        ];
    }
}

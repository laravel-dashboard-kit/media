<?php

namespace LDK\Media\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use WithFaker, RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            //
        ];
    }
}

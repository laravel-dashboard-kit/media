<?php

namespace LDK\Media\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use LDK\Media\Providers\MediaServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use WithFaker, RefreshDatabase;

    protected function setup(): void
    {
        parent::setUp();

        $this->createFakeMediaModelTable();
    }

    protected function getPackageProviders($app)
    {
        return [
            MediaServiceProvider::class,
        ];
    }

    private function createFakeMediaModelTable()
    {
        Schema::create('fake_model', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}

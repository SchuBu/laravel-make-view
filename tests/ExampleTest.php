<?php

namespace SchuBu\MakeView\Tests;

use Orchestra\Testbench\TestCase;
use SchuBu\MakeView\MakeViewServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MakeViewServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}

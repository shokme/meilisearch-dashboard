<?php

namespace Tests;

use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        DB::insert('insert into instances (host, key, active) values ("http://localhost:7700", null, 1)');
    }

    protected function tearDown(): void
    {
        Meili::deleteAllIndexes();
    }
}

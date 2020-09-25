<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Distinct;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DistinctTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_update_distinct_attribute()
    {
        Livewire::test(Distinct::class, ['uid' => 'foo'])
            ->call('update', 'bar')
            ->assertSee('bar')
            ->assertEmitted('notify-saved');
    }
}

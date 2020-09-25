<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Stats;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
        $index = Meili::getIndex('foo');
        $index->addDocuments([['id' => 1, 'title' => 'foo']]);
    }

    /** @test */
    public function can_see_stats()
    {
        Livewire::test(Stats::class, ['uid' => 'foo'])
            ->assertSee('Number of documents');
    }
}

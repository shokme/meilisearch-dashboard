<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Stopwords;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StopWordsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_update_stop_words()
    {
        Livewire::test(Stopwords::class, ['uid' => 'foo'])
            ->assertDontSee('bar')
            ->call('update', 'bar')
            ->assertSee('bar');
    }

    /** @test */
    public function can_delete_stop_words()
    {
        Livewire::test(Stopwords::class, ['uid' => 'foo'])
            ->call('update', 'bar')
            ->assertSee('bar')
            ->call('update', 'foo')
            ->assertSee('foo')
            ->call('delete', 0)
            ->assertDontSee('bar')
            ->call('delete', 0)
            ->assertDontSee('foo');
    }
}

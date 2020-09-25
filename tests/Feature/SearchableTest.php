<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Searchable;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SearchableTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_add_searchable_attribute()
    {
        Livewire::test(Searchable::class, ['uid' => 'foo'])
            ->assertDontSee('foo')
            ->assertDontSee('bar')
            ->set('attribute', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->set('attribute', 'foo')
            ->call('add')
            ->assertSee('foo')
            ->assertSee('bar');
    }

    /** @test */
    public function can_update_searchable_attribute_list()
    {
        Livewire::test(Searchable::class, ['uid' => 'foo'])
            ->call('update', [
                'bar',
                'foo',
                'baz'
            ])
            ->assertSee('bar')
            ->assertSee('foo')
            ->assertSee('baz');
    }

    /** @test */
    public function can_delete_searchable_attribute()
    {
        Livewire::test(Searchable::class, ['uid' => 'foo'])
            ->assertDontSee('bar')
            ->set('attribute', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->set('attribute', 'foo')
            ->call('add')
            ->call('delete', 0)
            ->assertDontSee('foo')
            ->assertSee('bar')
            ->call('delete', 0)
            ->assertDontSee('foo');
    }
}

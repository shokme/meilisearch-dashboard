<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Facet;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FacetTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_add_attribute_for_faceting()
    {
        Livewire::test(Facet::class, ['uid' => 'foo'])
            ->assertDontSee('bar')
            ->set('attribute', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->set('attribute', 'baz')
            ->call('add')
            ->set('attribute', 'foo')
            ->call('add')
            ->assertSee('foo')
            ->assertSee('bar')
            ->assertSee('baz');
    }

    /** @test */
    public function can_delete_attribute_for_faceting()
    {
        Livewire::test(Facet::class, ['uid' => 'foo'])
            ->assertDontSee('bar')
            ->set('attribute', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->set('attribute', 'baz')
            ->call('add')
            ->call('delete', 0)
            ->assertDontSee('bar')
            ->assertSee('baz');
    }
}

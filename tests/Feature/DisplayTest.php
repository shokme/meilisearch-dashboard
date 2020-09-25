<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Display;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DisplayTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_see_all()
    {
        Livewire::test(Display::class, ['uid' => 'foo'])
            ->assertSee('*');
    }

    /** @test */
    public function can_update_display_attributes()
    {
        Livewire::test(Display::class, ['uid' => 'foo'])
            ->assertSee('*')
            ->assertDontSee('foo')
            ->set('attribute', 'foo')
            ->call('update')
            ->assertSee('foo')
            ->set('attribute', 'bar')
            ->call('update')
            ->assertSee('bar')
            ->set('attribute', 'baz')
            ->call('update')
            ->assertSee('foo')
            ->assertSee('bar')
            ->assertSee('baz');
    }

    /** @test */
    public function can_delete_display_attributes()
    {
        Livewire::test(Display::class, ['uid' => 'foo'])
            ->set('attribute', 'foo')
            ->call('update')
            ->set('attribute', 'bar')
            ->call('update')
            ->assertSee('foo')
            ->call('delete', 'foo')
            ->assertDontSee('foo')
            ->assertSee('bar');
    }
}

<?php

namespace Tests\Feature;

use App\Http\Livewire\Indexes;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use MeiliSearch\Exceptions\HTTPRequestException;
use Tests\TestCase;

class IndexesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_a_new_index()
    {
        Livewire::test(Indexes::class)
            ->set('uid', 'foo')
            ->call('create');

        $index = Meili::getIndex('foo');
        $this->assertArrayHasKey('numberOfDocuments', $index->stats());
    }

    /** @test */
    public function show_a_message_on_existing_index()
    {
        $this->expectException(HTTPRequestException::class);

        Livewire::test(Indexes::class)
            ->set('uid', 'foo')
            ->call('create');

        Livewire::test('indexes')
            ->set('uid', 'foo')
            ->call('create');
    }

    /** @test */
    public function can_delete_an_existing_index()
    {
        $this->expectException(HTTPRequestException::class);

        Meili::createIndex('foo');

        Livewire::test(Indexes::class)
            ->call('delete', 'foo');

        $index = Meili::getIndex('foo');
        $index->stats();
    }

    /** @test */
    public function can_see_indexes()
    {
        Livewire::test(Indexes::class)
            ->assertDontSee('foo')
            ->assertDontSee('bar')
            ->set('uid', 'foo')
            ->call('create')
            ->assertSee('foo')
            ->assertDontSee('bar')
            ->set('uid', 'bar')
            ->call('create')
            ->assertSee('foo')
            ->assertSee('bar');
    }
}

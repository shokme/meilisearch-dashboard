<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Synonym;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SynonymTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_update_synonym()
    {
        Livewire::test(Synonym::class, ['uid' => 'foo'])
            ->set('type', 'synonyms')
            ->set('updateSynonyms', 'foo,bar')
            ->call('update')
            ->assertSee('foo')
            ->assertSee('bar');
    }

    /** @test */
    public function can_update_synonym_one_way()
    {
        Livewire::test(Synonym::class, ['uid' => 'foo'])
            ->set('type', 'oneway')
            ->set('updateSynonyms', 'foo')
            ->set('alternative', 'bar,baz')
            ->call('update')
            ->assertSee('foo')
            ->assertSee('baz')
            ->assertSee('bar');
    }

    /** @test */
    public function can_delete_synonym()
    {
        Livewire::test(Synonym::class, ['uid' => 'foo'])
            ->set('type', 'synonyms')
            ->set('updateSynonyms', 'foo,bar')
            ->call('update')
            ->assertSee('foo')
            ->assertSee('bar')
            ->call('delete', 'foo');

        $synonyms = Meili::getIndex('foo')->getSynonyms();
        $this->assertArrayNotHasKey('foo', $synonyms);
        $this->assertArrayHasKey('bar', $synonyms);
    }

    /** @test */
    public function can_reset_all_synonym()
    {
        Meili::getIndex('foo')->resetSynonyms();

        Livewire::test(Synonym::class, ['uid' => 'foo'])
            ->call('delete', '*');

        $synonyms = Meili::getIndex('foo')->getSynonyms();
        $this->assertEmpty($synonyms);
    }
}

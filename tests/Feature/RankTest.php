<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard\Rank;
use App\Support\Facades\Meili;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RankTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Meili::createIndex('foo');
    }

    /** @test */
    public function can_add_rank_attribute()
    {
        Livewire::test(Rank::class, ['uid' => 'foo'])
            ->set('word', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->assertSee('Ascending');
    }

    /** @test */
    public function can_add_descending_rank_attribute()
    {
        Livewire::test(Rank::class, ['uid' => 'foo'])
            ->set('order', 'desc')
            ->set('word', 'bar')
            ->call('add')
            ->assertSee('bar')
            ->assertSee('Descending');
    }

    /** @test */
    public function can_update_rank_attribute_list()
    {
        Livewire::test(Rank::class, ['uid' => 'foo'])
            ->call('update', [
                'typo',
                'words',
                'proximity',
                'attribute',
                'asc(bar)',
                'wordsPosition',
                'exactness',
                'desc(rank)'
            ])
            ->assertSee('bar')
            ->assertSee('typo')
            ->assertSee('exactness');
    }

    /** @test */
    public function can_delete_rank_attribute()
    {
        Livewire::test(Rank::class, ['uid' => 'foo'])
            ->set('word', 'bar')
            ->call('add')
            ->set('word', 'foo')
            ->call('add')
            ->assertSee('bar')
            ->call('delete', 1)
            ->assertDontSee('bar')
            ->assertSee('foo');
    }
}

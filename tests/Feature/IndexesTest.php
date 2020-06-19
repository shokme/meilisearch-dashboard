<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexesTest extends TestCase
{
    /** @test */
    public function can_add_a_new_index()
    {
        Livewire::test('indices')
            ->call('create', 'foo');
    }

    /** @test */
    public function show_a_message_on_existing_index()
    {
        Livewire::test('indices')
            ->call('create', 'foo');
    }

    /** @test */
    public function can_delete_an_existing_index()
    {
        Livewire::test('indices')
            ->call('delete', 'foo');
    }
}

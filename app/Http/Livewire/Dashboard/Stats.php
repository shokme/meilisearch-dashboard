<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Stats extends Component
{
    use MeilisearchTrait;

    public string $index;

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.stats', ['stats' => $this->index()->stats()])
            ->extends('layouts.panel')
            ->section('panel');
    }
}

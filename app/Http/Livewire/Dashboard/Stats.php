<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Illuminate\Support\Arr;
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
        $stats = $this->index()->stats();
        $distribution = Arr::sortRecursive($stats['fieldsDistribution']);

        return view('livewire.dashboard.stats', ['stats' => $stats, 'distribution' => $distribution])
            ->extends('layouts.panel')
            ->section('panel');
    }
}

<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public string $index;

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.index')
            ->extends('layouts.panel')
            ->section('panel');
    }
}

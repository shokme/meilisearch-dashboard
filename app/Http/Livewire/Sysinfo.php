<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
use Livewire\Component;

class Sysinfo extends Component
{
    public function render()
    {
        return view('livewire.sysinfo', ['sys' => Meili::prettySysInfo()])->extends('layouts.app');
    }
}

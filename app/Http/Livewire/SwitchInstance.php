<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SwitchInstance extends Component
{
    public function get()
    {
        return DB::table('instances')->select('host', 'active')->orderBy('active', 'desc')->get();
    }

    public function toggle($host)
    {
        DB::table('instances')->update(['active' => 0]);
        DB::table('instances')->where('host', $host)->update(['active' => 1]);
        $this->emitUp('instanceSwitched');
    }

    public function render()
    {
        return view('livewire.switch-instance', ['instances' => $this->get()]);
    }
}

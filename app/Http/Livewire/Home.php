<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use MeiliSearch\Client;

class Home extends Component
{
    public $host = '';
    public $key = null;

    public function connect()
    {
        DB::table('instances')->update(['active' => 0]);
        DB::table('instances')->updateOrInsert(['host' => $this->host], ['key' => $this->key, 'active' => 1]);

        return $this->redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.home');
    }
}

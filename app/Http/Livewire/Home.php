<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
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
        DB::table('instances')->updateOrInsert(['host' => $this->host, 'key' => $this->key]);
        Config::set('meilisearch.host', $this->host);
        Config::set('meilisearch.key', $this->key);

        return $this->redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.home');
    }
}

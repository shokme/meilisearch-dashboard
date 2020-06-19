<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Exceptions\HTTPRequestException;

class Indexes extends Component
{
    public function create($uid, $options = [])
    {
        try {
            Meili::createIndex($uid, $options);
        } catch (HTTPRequestException $exception) {
            // TODO: Flash message index already exists.
        }
    }

    public function delete($uid)
    {
        Meili::deleteIndex($uid);
    }

    public function render()
    {
        return view('livewire.indexes');
    }
}

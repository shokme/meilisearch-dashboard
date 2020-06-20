<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Exceptions\HTTPRequestException;

class Indexes extends Component
{
    public string $uid = '';
    public string $pk = 'id';

    public function create()
    {
        $this->validate([
            'uid' => 'required|min:3',
        ]);

        try {
            Meili::createIndex($this->uid, ['primaryKey' => $this->pk]);
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
        $indexes = collect(Meili::getAllIndexes())->map(function ($index) {
            $stats = Meili::getIndex($index['uid'])->stats();

            return array_merge($index, $stats);
        })->all();

        return view('livewire.indexes', ['indexes' => $indexes]);
    }
}

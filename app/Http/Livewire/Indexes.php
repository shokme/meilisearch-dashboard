<?php

namespace App\Http\Livewire;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Indexes extends Component
{
    public string $uid = '';
    public string $pk = 'id';

    protected $listeners = ['instanceSwitched' => 'render'];

    public function create()
    {
        $this->validate([
            'uid' => 'required',
        ]);

        Meili::createIndex($this->uid, ['primaryKey' => $this->pk]);

        $this->reset();
    }

    public function delete($uid)
    {
        Meili::deleteIndex($uid);
    }

    public function render()
    {
        $indexes = collect(Meili::getAllIndexes())->map(function (\MeiliSearch\Endpoints\Indexes $index) {
            $stats = Meili::getIndex($index->getUid())->stats();

            return array_merge($index->show(), $stats);
        })->all();

        return view('livewire.indexes', ['indexes' => $indexes]);
    }
}

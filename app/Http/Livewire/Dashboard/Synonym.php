<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;

class Synonym extends Component
{
    public string $index;

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

    public function getSynonyms()
    {
       return $this->index()->getSynonyms();
    }

    public function updateSynonyms($synonyms = [])
    {
        $synonyms = ['foo' => ['bar', 'baz'], 'bar' => ['foo', 'baz'], 'baz'=> ['foo', 'bar']];
        $status = $this->index()->updateSynonyms($synonyms);
        $this->waitUpdate($status);
    }

    public function deleteSynonyms($synonyms)
    {
        $all = $this->index()->getSynonyms();
        unset($all[$synonyms]);
        if(!count($all)) {
            $status = $this->index()->resetSynonyms();
            $this->waitUpdate($status);

            return;
        }
        $status = $this->index()->updateSynonyms($all);
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.synonym', ['synonyms' => $this->getSynonyms()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

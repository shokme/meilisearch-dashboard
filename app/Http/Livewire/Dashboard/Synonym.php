<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;

class Synonym extends Component
{
    public string $index;
    public $updateSynonyms;
    public $alternative;
    public $type = 'synonyms';

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

    public function get()
    {
       return $this->index()->getSynonyms();
    }

    public function update()
    {
        if($this->type === 'synonyms') {
            $synonyms = explode(',', $this->updateSynonyms);
            if(count($synonyms) < 2) {
                // validate
            }

            $data = collect($synonyms)->flatMap(function ($synonym) use ($synonyms) {
                return [$synonym => array_values(array_diff($synonyms, [$synonym]))];
            })->all();
        }

        if($this->type === 'oneway') {
            $data[$this->updateSynonyms] = explode(',', $this->alternative);
        }

        $data = array_merge($this->get(), $data);

        $status = $this->index()->updateSynonyms($data);
        $this->waitUpdate($status);
    }

    public function delete($synonyms)
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
        return view('livewire.dashboard.synonym', ['synonyms' => $this->get()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

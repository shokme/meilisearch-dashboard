<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Synonym extends Component
{
    use MeilisearchTrait;

    public string $index;
    public $updateSynonyms;
    public $alternative;
    public $type = 'synonyms';

    public function get()
    {
       return $this->index()->getSynonyms();
    }

    public function update()
    {
        if($this->type === 'synonyms') {
            $synonyms = explode(',', $this->updateSynonyms);
            if(count($synonyms) < 2) {
                // TODO: validate
                return;
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
        $this->reset('updateSynonyms', 'alternative');
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
        return view('livewire.dashboard.synonym', ['synonyms' => $this->get()])
            ->extends('layouts.panel')
            ->section('panel');
    }
}

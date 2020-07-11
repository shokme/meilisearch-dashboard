<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Stopwords extends Component
{
    use MeilisearchTrait;

    public string $index;

    public function get()
    {
       return $this->index()->getStopWords();
    }

    public function update($word)
    {
        $words = [...$this->get(), $word];
        $status = $this->index()->updateStopWords($words);
        $this->waitUpdate($status);
    }

    public function delete($word)
    {
        $all = $this->get();
        unset($all[$word]);
        $status = $this->index()->updateStopWords(array_values($all));
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.stopwords', ['stopwords' => $this->get()]);
    }
}

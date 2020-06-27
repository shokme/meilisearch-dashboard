<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;

class StopWord extends Component
{
    public string $index;

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

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

    public function resetStopWords()
    {
        $status = $this->index()->resetStopWords();
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.stop-word', ['stopwords' => $this->get()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

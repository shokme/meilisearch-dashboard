<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Distinct extends Component
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
        return $this->index()->getDistinctAttribute();
    }

    public function update($attribute)
    {
        $status = $this->index()->updateDistinctAttribute($attribute);
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.distinct', ['attribute' => $this->get()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

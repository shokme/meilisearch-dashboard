<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Facet extends Component
{
    public string $index;
    public string $attribute = '';

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

    public function get()
    {
        return $this->index()->getAttributesForFaceting();
    }

    public function add()
    {
        $this->validate(['attribute' => 'required']);

        $attributes = [...$this->get(), $this->attribute];
        $status = $this->index()->updateAttributesForFaceting($attributes);
        $this->waitUpdate($status);
        $this->reset('attribute');
    }

    public function delete($id)
    {
        $attributes = $this->get();
        unset($attributes[$id]);

        $status = $this->index()->updateAttributesForFaceting(array_values($attributes));
        $this->waitUpdate($status);
    }

    public function resetAttributes()
    {
        $status = $this->index()->resetAttributesForFaceting();
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.facet', ['facets' => $this->get()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

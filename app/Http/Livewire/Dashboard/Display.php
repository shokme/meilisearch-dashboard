<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;

class Display extends Component
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

    public function acceptFields()
    {
        return $this->index()->getAcceptNewFields();
    }

    public function toggleFields()
    {
        $status = $this->index()->updateAcceptNewFields(!$this->acceptFields());
        $this->waitUpdate($status);
    }

    public function get()
    {
       return $this->index()->getDisplayedAttributes();
    }

    public function update()
    {
        $attributes = [...$this->get(), $this->attribute];
        $status = $this->index()->updateDisplayedAttributes(array_values($attributes));
        $this->waitUpdate($status);
        $this->reset('attribute');
    }

    public function delete($id)
    {
        $all = $this->get();
        unset($all[$id]);
        $status = $this->index()->updateDisplayedAttributes(array_values($all));
        $this->waitUpdate($status);
    }

    public function resetAttributes()
    {
        $status = $this->index()->resetDisplayedAttributes();
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.display', ['attributes' => $this->get(), 'acceptFields' => $this->acceptFields()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

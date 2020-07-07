<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Display extends Component
{
    use MeilisearchTrait;

    public string $index;
    public string $attribute = '';

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

    public function acceptFields()
    {
        return $this->index()->getAcceptNewFields();
    }

    public function toggleFields()
    {
        $status = $this->index()->updateAcceptNewFields(!$this->acceptFields());
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
}

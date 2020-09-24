<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Facet extends Component
{
    use MeilisearchTrait;

    public string $index;
    public string $attribute = '';

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

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.facet', ['facets' => $this->get()])
            ->extends('layouts.panel')
            ->section('panel');
    }
}

<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Livewire\Component;

class Distinct extends Component
{
    use MeilisearchTrait;

    public string $index;

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
}

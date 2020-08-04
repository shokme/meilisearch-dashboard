<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use App\Support\UpdateOrderTrait;
use Livewire\Component;

class Searchable extends Component
{
    use MeilisearchTrait, UpdateOrderTrait;

    public string $index;
    public string $attribute = '';

    public function get()
    {
        return $this->index()->getSearchableAttributes();
    }

    public function add()
    {
        if($this->get()[0] === '*') {
            $list = [$this->attribute];
        } else {
            $list = [$this->attribute, ...$this->get()];
        }

        $status = $this->index()->updateSearchableAttributes($list);
        $this->reset('attribute');
        $this->waitUpdate($status);
    }

    public function update($list)
    {
        $status = $this->index()->updateSearchableAttributes($list);
        $this->waitUpdate($status);
    }

    public function delete($id)
    {
        $all = $this->get();
        unset($all[$id]);
        $status = $this->index()->updateSearchableAttributes(array_values($all));
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.searchable', ['attributes' => $this->get()]);
    }
}

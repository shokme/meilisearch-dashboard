<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use Illuminate\Support\Str;
use Livewire\Component;

class Searchable extends Component
{
    use MeilisearchTrait;

    public string $index;
    public string $attribute = '';

    public function get()
    {
        return $this->index()->getSearchableAttributes();
    }

    public function add()
    {
        $list = $this->get();
        $list = [$this->attribute, ...$list];

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

    public function updateOrder($rule, $order)
    {
        $rules = collect($this->get())->map(function ($item) use ($rule, $order) {
            if($item !== $rule) {
                return $item;
            }

            if(Str::contains($rule, $order)) {
                return $item;
            } else {
                $attribute = Str::between($rule, '(', ')');
                $orderBy = Str::before($rule, $attribute);
                return str_replace($orderBy, $order.'(', $rule);
            }
        })->all();

        $status = $this->index()->updateSearchableAttributes($rules);
        $this->waitUpdate($status);
    }
}

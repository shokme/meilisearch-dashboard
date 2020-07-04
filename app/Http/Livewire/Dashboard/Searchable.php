<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Illuminate\Support\Str;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Searchable extends Component
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

    public function delete($id)
    {
        $all = $this->get();
        unset($all[$id]);
        $status = $this->index()->updateSearchableAttributes(array_values($all));
        $this->waitUpdate($status);
    }

    public function resetSearchable()
    {
        $status = $this->index()->resetSearchableAttributes();
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

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

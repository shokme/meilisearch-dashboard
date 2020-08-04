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
        if($this->get()[0] === '*') {
            $attributes = [$this->attribute];
        } else {
            $attributes = [...$this->get(), $this->attribute];
        }
        $status = $this->index()->updateDisplayedAttributes(array_values($attributes));
        $this->waitUpdate($status);
        $this->reset('attribute');
    }

    public function delete($attribute)
    {
        $all = $this->get();
        foreach ($all as $i => $v) {
            if ($v === $attribute) {
                unset($all[$i]);
                break;
            }
        }
        $status = $this->index()->updateDisplayedAttributes(array_values($all));
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.display', ['attributes' => $this->get()]);
    }
}

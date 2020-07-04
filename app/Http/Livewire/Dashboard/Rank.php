<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\MeilisearchTrait;
use App\Support\UpdateOrderTrait;
use Livewire\Component;

class Rank extends Component
{
    use MeilisearchTrait, UpdateOrderTrait;

    public string $index;
    public string $word = '';
    public string $order = 'asc';

    public function get()
    {
        return $this->index()->getRankingRules();
    }

    public function add()
    {
        $list = $this->get();
        $list = ["{$this->order}({$this->word})", ...$list];

        $status = $this->index()->updateRankingRules($list);
        $this->reset('word');
        $this->waitUpdate($status);
    }

    public function update($list)
    {
        $status = $this->index()->updateRankingRules($list);
        $this->waitUpdate($status);
    }

    public function delete($id)
    {
        $all = $this->get();
        unset($all[$id]);
        $status = $this->index()->updateRankingRules(array_values($all));
        $this->waitUpdate($status);
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.rank', ['rules' => $this->get()]);
    }
}

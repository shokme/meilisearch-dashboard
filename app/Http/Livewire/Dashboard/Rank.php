<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Illuminate\Support\Str;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Rank extends Component
{
    public string $index;
    public string $word = '';
    public string $order = 'asc';

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

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

        $status = $this->index()->updateRankingRules($rules);
        $this->waitUpdate($status);
    }

    public function delete($id)
    {
        $all = $this->get();
        unset($all[$id]);
        $status = $this->index()->updateRankingRules(array_values($all));
        $this->waitUpdate($status);
    }

    public function resetRankingRules()
    {
        $status = $this->index()->resetRankingRules();
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

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

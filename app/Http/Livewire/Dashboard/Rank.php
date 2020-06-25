<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Rank extends Component
{
    public string $index;

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

    public function rules()
    {
        return $this->index()->getRankingRules();
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.rank', ['rules' => $this->rules()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

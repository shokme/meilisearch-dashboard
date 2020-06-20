<?php

namespace App\Http\Livewire\Dashboard;

use App\Support\Facades\Meili;
use Livewire\Component;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\HTTPRequestException;

class Facet extends Component
{
    public string $index;

    /**
     * @return Client
     */
    private function index()
    {
        return Meili::getIndex($this->index);
    }

    public function getAttributes()
    {
        return $this->index()->getAttributesForFaceting();
    }

    public function addAttribute($attributes = [])
    {
        // Get all attributes
        // Merge New Attributes
        // Diff deleted attributes
        try {
            $status = $this->index()->updateAttributesForFaceting($attributes);
            $this->waitUpdate($status);
        } catch (HTTPRequestException $exception) {
            dd($exception);
        }
    }

    public function mount($uid)
    {
        $this->index = $uid;
    }

    public function render()
    {
        return view('livewire.dashboard.facet', ['facets' => $this->getAttributes()]);
    }

    private function waitUpdate($id)
    {
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

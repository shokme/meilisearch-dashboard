<?php

namespace App\Support;

use App\Support\Facades\Meili;
use Illuminate\Support\Str;
use MeiliSearch\Endpoints\Indexes;
use MeiliSearch\Exceptions\TimeOutException;

trait MeilisearchTrait
{
    private function index(): Indexes
    {
        return Meili::getIndex($this->index);
    }

    public function restore($action)
    {
        $call = 'reset'.$action;
        $status = $this->index()->$call();
        $this->waitUpdate($status);
    }

    private function waitUpdate($id)
    {
        try {
            $this->index()->waitForPendingUpdate($id['updateId'], 1500);
        } catch (TimeOutException $exception) {
            $this->dispatchBrowserEvent('indexing', ['message' => 'Indexing in progress for '.Str::afterLast($this->index, '\\')]);
            // TODO: find a better way to keep the user inform on progress.
        }
    }
}

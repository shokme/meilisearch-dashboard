<?php

namespace App\Support;

use App\Support\Facades\Meili;
use MeiliSearch\Client;

trait MeilisearchTrait
{
    /**
     * @return Client
     */
    private function index()
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
        while($this->index()->getUpdateStatus($id['updateId'])['status'] === 'enqueued') {
            usleep(100 * 1000);
            continue;
        }
    }
}

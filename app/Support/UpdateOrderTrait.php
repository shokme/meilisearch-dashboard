<?php

namespace App\Support;

use Illuminate\Support\Str;

trait UpdateOrderTrait
{
    public function updateOrder($rule, $order)
    {
        $rules = collect($this->get())->map(function ($item) use ($rule, $order) {
            if ($item !== $rule) {
                return $item;
            }

            if (Str::contains($rule, $order)) {
                return $item;
            }

            $attribute = Str::between($rule, '(', ')');
            $orderBy = Str::before($rule, $attribute);
            return str_replace($orderBy, $order.'(', $rule);
        })->all();

        $status = $this->index()->updateRankingRules($rules);
        $this->waitUpdate($status);
    }
}

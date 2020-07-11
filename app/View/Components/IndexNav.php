<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IndexNav extends Component
{
    public $uid;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->uid = request()->route()->parameter('uid');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.index-nav');
    }
}

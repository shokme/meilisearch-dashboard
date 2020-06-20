<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalCenteredAction extends Component
{
    public string $label;
    public string $action;

    public function __construct(string $label = '', string $action = 'Create')
    {
        $this->label = $label;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.modal-centered-action');
    }
}

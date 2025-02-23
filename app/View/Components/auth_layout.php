<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class auth_layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $word;
    public function __construct($word="deaultf")
    {
        $this->word=$word;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth_layout');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    /**
     * Create a new component instance.
     */

     public string $content;

     public string $toRoute;

     public $item;


    public function __construct($content, $toRoute, $item)
    {
        $this->content = $content;
        $this->toRoute = $toRoute;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show');
    }
}

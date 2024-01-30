<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class main2 extends Component
{
    /**
     * Create a new component instance.
     */
    public string $heading;
    public string $content;
    public  $toRoute;
    public function __construct($content,$heading,$toRoute)
    {
        $this->heading = $heading;
        $this->content = $content;
        $this->toRoute = $toRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main2');
    }
}

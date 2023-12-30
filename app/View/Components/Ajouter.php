<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Ajouter extends Component
{
    /**
     * Create a new component instance.
     */
    public string $content;

    public string $toRoute;

    public function __construct($content, $toRoute)
    {
        $this->content = $content;
        $this->toRoute = $toRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ajouter');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Trash extends Component
{
    /**
     * Create a new component instance.
     */
    public string $heading;

    public string $content;

    public $publiee;

    public $trashed;

    public $allPubliee;
    
    public $allTrashed;

    public function __construct($heading, $content, $publiee, $trashed, $allPubliee, $allTrashed)
    {
        $this->heading = $heading;
        $this->content = $content;
        $this->publiee = $publiee;
        $this->trashed = $trashed;
        $this->allPubliee = $allPubliee;
        $this->allTrashed = $allTrashed;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trash');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobtypeBadge extends Component
{
    /**
     * Create a new component instance.
     */
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Using double curly braces for Blade rendering
        return <<<blade
<div class="text-right"><small class="badge text-bg-info">$this->type</small></div>
blade;
    }
}

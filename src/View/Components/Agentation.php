<?php

namespace YourVendor\AgentationLaravel\View\Components;

use Illuminate\View\Component;

class Agentation extends Component
{
    public function __construct(
        public ?string $endpoint = null,
    ) {}

    public function shouldRender(): bool
    {
        return app()->environment('local');
    }

    public function render()
    {
        return view('agentation::components.agentation');
    }
}

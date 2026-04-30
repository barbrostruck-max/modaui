<?php

namespace modaui\Updater\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Li extends Component
{
    public function __construct(
        public array $item
    ) {}

    public function render(): View
    {
        return view('modaui-updater::components.li', [
            'item' => $this->item,
        ]);
    }
}

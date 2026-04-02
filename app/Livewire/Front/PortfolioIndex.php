<?php

namespace App\Livewire\Front;

use App\Models\PortfolioItem;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PortfolioIndex extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.front.portfolio-index', [
            'items' => PortfolioItem::latest()->get(),
        ]);
    }
}

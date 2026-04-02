<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $user = Auth::user();
        $client = $user->client;

        return view('livewire.client.dashboard', [
            'projects' => $client ? $client->projects()->with('tasks')->get() : [],
            'invoices' => $client ? $client->projects()->with('invoices')->get()->pluck('invoices')->flatten() : [],
            'tickets' => [], // Placeholder for now
        ]);
    }
}

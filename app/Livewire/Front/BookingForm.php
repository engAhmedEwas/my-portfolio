<?php

namespace App\Livewire\Front;

use App\Models\Lead;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class BookingForm extends Component
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:10')]
    public $message = '';

    public $success = false;

    #[Layout('layouts.app')]
    public function save()
    {
        $this->validate();

        Lead::create([
            'type' => 'Booking',
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->success = true;
        $this->reset(['name', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.front.booking-form');
    }
}

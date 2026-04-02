<?php

namespace App\Livewire\Front\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ThemeToggle extends Component
{
    public $theme = 'light';

    public function mount()
    {
        if (Auth::check()) {
            $this->theme = Auth::user()->theme_preference ?? 'light';
        } else {
            // Fallback or session based if needed, but for now default to light
            // In a real app, we might check session or cookie
        }
    }

    public function toggle()
    {
        $this->theme = $this->theme === 'light' ? 'dark' : 'light';

        if (Auth::check()) {
            $user = Auth::user();
            $user->theme_preference = $this->theme;
            $user->save();
        }

        $this->dispatch('theme-changed', theme: $this->theme);
    }

    public function render()
    {
        return view('livewire.front.components.theme-toggle');
    }
}

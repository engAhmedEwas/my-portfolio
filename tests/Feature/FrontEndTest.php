<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FrontEndTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_page_loads()
    {
        PortfolioItem::create(['title' => 'Test Item', 'slug' => 'test-item']);

        $this->get('/portfolio')
            ->assertStatus(200)
            ->assertSee('Test Item');
    }

    public function test_booking_form_creates_lead()
    {
        Livewire::test(\App\Livewire\Front\BookingForm::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('message', 'I want to book a consultation.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('leads', [
            'type' => 'Booking',
            'email' => 'john@example.com',
        ]);
    }

    public function test_quote_form_creates_lead()
    {
        Livewire::test(\App\Livewire\Front\RequestQuoteForm::class)
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('message', 'I need a quote for a website.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('leads', [
            'type' => 'Quote Request',
            'email' => 'jane@example.com',
        ]);
    }
}

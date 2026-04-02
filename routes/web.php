<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Front\PortfolioIndex;
use App\Livewire\Front\BookingForm;
use App\Livewire\Front\RequestQuoteForm;
use App\Livewire\Client\Dashboard as ClientDashboard;
use App\Http\Middleware\EnsureUserIsClient;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', PortfolioIndex::class)->name('home');
        Route::get('/portfolio', PortfolioIndex::class)->name('portfolio.index');
        Route::get('/book', BookingForm::class)->name('booking.form');
        Route::get('/quote', RequestQuoteForm::class)->name('quote.form');
    }
);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

// Client dashboard is now handled by Filament Client Panel at /client
// Route::middleware(['auth', 'verified', EnsureUserIsClient::class])
//     ->prefix('client')
//     ->name('client.')
//     ->group(function () {
//         Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
//     });

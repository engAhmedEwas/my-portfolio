<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\SupportTicket;

$user = User::where('email', 'client@test.com')->first();

if (!$user) {
    echo "User not found!\n";
    exit(1);
}

// Create Client
$client = Client::updateOrCreate(
    ['email' => 'client@test.com'],
    [
        'company_name' => 'Test Company Inc',
        'contact_person' => 'Test Client',
        'phone' => '+1-555-0123',
        'address' => '123 Test Street, Test City',
        'user_id' => $user->id,
    ]
);

echo "✓ Client created: {$client->company_name}\n";
echo "  Client ID: {$client->id}\n\n";

// Create Projects
$projects = [
    [
        'title' => 'Website Redesign Project',
        'description' => 'Complete redesign of company website with modern UI/UX',
        'budget' => 5000,
        'status' => 'Active',
    ],
    [
        'title' => 'Mobile App Development',
        'description' => 'Native iOS and Android mobile application',
        'budget' => 15000,
        'status' => 'Active',
    ],
    [
        'title' => 'E-commerce Integration',
        'description' => 'Integration of payment gateway and inventory system',
        'budget' => 8000,
        'status' => 'Completed',
    ],
];

foreach ($projects as $projectData) {
    $projectData['client_id'] = $client->id;
    Project::create($projectData);
}

echo "✓ Created 3 projects\n\n";

// Create Invoices
Invoice::create([
    'client_id' => $client->id,
    'invoice_number' => 'INV-2024-001',
    'total_amount' => 2500,
    'status' => 'Paid',
    'due_date' => now()->subDays(10),
    'paid_at' => now()->subDays(5),
    'description' => 'Website Redesign - Phase 1',
]);

Invoice::create([
    'client_id' => $client->id,
    'invoice_number' => 'INV-2024-002',
    'total_amount' => 7500,
    'status' => 'Pending',
    'due_date' => now()->addDays(15),
    'description' => 'Mobile App Development - Milestone 1',
]);

echo "✓ Created 2 invoices\n\n";

// Create Support Tickets
SupportTicket::create([
    'client_id' => $client->id,
    'subject' => 'Login Issue on Admin Panel',
    'description' => 'Cannot access admin panel, password reset not working',
    'priority' => 'High',
    'status' => 'Open',
]);

SupportTicket::create([
    'client_id' => $client->id,
    'subject' => 'Feature Request: Dark Mode',
    'description' => 'Would like to have dark mode option in the dashboard',
    'priority' => 'Low',
    'status' => 'In Progress',
]);

echo "✓ Created 2 support tickets\n\n";
echo "========================================\n";
echo "✓ Test data created successfully!\n";
echo "  Login as: client@test.com\n";
echo "  Password: password\n";
echo "========================================\n";

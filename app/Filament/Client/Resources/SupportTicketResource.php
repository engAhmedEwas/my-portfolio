<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\SupportTicketResource\Pages;
use App\Models\SupportTicket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SupportTicketResource extends Resource
{
    protected static ?string $model = SupportTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Support Tickets';

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        $clientId = auth()->user()->client->id ?? null;

        return parent::getEloquentQuery()
            ->where('client_id', $clientId)
            ->orderBy('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255)
                    ->label('Subject'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
                    ->default('Medium')
                    ->required()
                    ->label('Priority'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull()
                    ->label('Description'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Open' => 'Open',
                        'In Progress' => 'In Progress',
                        'Closed' => 'Closed',
                    ])
                    ->default('Open')
                    ->disabled()
                    ->dehydrated(false)
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->sortable()
                    ->label('Subject')
                    ->weight('bold')
                    ->limit(50),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'success' => 'Low',
                        'warning' => 'Medium',
                        'danger' => 'High',
                    ])
                    ->label('Priority'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'info' => 'Open',
                        'warning' => 'In Progress',
                        'success' => 'Closed',
                    ])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created')
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Open' => 'Open',
                        'In Progress' => 'In Progress',
                        'Closed' => 'Closed',
                    ]),
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // No bulk actions
            ])
            ->emptyStateHeading('No Support Tickets')
            ->emptyStateDescription('You haven\'t created any support tickets yet.')
            ->emptyStateIcon('heroicon-o-ticket')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Create Ticket')
                    ->icon('heroicon-o-plus'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupportTickets::route('/'),
            'create' => Pages\CreateSupportTicket::route('/create'),
            'view' => Pages\ViewSupportTicket::route('/{record}'),
        ];
    }

    // Allow clients to create tickets
    public static function canCreate(): bool
    {
        return true;
    }

    // Don't allow editing (only viewing)
    public static function canEdit($record): bool
    {
        return false;
    }
}

<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'My Projects';

    protected static ?int $navigationSort = 1;

    // Filter to show only projects for the logged-in client
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
                Forms\Components\TextInput::make('title')
                    ->disabled()
                    ->label('Project Title'),
                Forms\Components\Textarea::make('description')
                    ->disabled()
                    ->columnSpanFull()
                    ->label('Description'),
                Forms\Components\TextInput::make('budget')
                    ->disabled()
                    ->numeric()
                    ->prefix('$')
                    ->label('Budget'),
                Forms\Components\Select::make('status')
                    ->disabled()
                    ->options([
                        'Active' => 'Active',
                        'Cancelled' => 'Cancelled',
                        'Completed' => 'Completed',
                    ])
                    ->label('Status'),
                Forms\Components\DateTimePicker::make('created_at')
                    ->disabled()
                    ->label('Created At'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Project Title')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('budget')
                    ->money('USD')
                    ->sortable()
                    ->label('Budget'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Completed',
                        'warning' => 'Active',
                        'danger' => 'Cancelled',
                    ])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Start Date')
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Active' => 'Active',
                        'Cancelled' => 'Cancelled',
                        'Completed' => 'Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // No bulk actions for clients
            ])
            ->emptyStateHeading('No Projects Yet')
            ->emptyStateDescription('You don\'t have any projects assigned yet.')
            ->emptyStateIcon('heroicon-o-briefcase');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }

    // Disable create/edit/delete for clients
    public static function canCreate(): bool
    {
        return false;
    }
}

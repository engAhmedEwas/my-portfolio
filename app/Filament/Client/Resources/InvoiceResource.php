<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'My Invoices';

    protected static ?int $navigationSort = 2;

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
                Forms\Components\TextInput::make('invoice_number')
                    ->disabled()
                    ->label('Invoice #'),
                Forms\Components\TextInput::make('total_amount')
                    ->disabled()
                    ->numeric()
                    ->prefix('$')
                    ->label('Amount'),
                Forms\Components\Select::make('status')
                    ->disabled()
                    ->options([
                        'Paid' => 'Paid',
                        'Pending' => 'Pending',
                        'Overdue' => 'Overdue',
                    ])
                    ->label('Payment Status'),
                Forms\Components\DateTimePicker::make('due_date')
                    ->disabled()
                    ->label('Due Date'),
                Forms\Components\DateTimePicker::make('paid_at')
                    ->disabled()
                    ->label('Paid At'),
                Forms\Components\Textarea::make('description')
                    ->disabled()
                    ->columnSpanFull()
                    ->label('Description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable()
                    ->label('Invoice #')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('USD')
                    ->sortable()
                    ->label('Amount'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Paid',
                        'warning' => 'Pending',
                        'danger' => 'Overdue',
                    ])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable()
                    ->label('Due Date'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Issued')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Paid' => 'Paid',
                        'Pending' => 'Pending',
                        'Overdue' => 'Overdue',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // No bulk actions
            ])
            ->emptyStateHeading('No Invoices Yet')
            ->emptyStateDescription('You don\'t have any invoices.')
            ->emptyStateIcon('heroicon-o-currency-dollar');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'view' => Pages\ViewInvoice::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}

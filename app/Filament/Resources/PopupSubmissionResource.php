<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopupSubmissionResource\Pages;
use App\Filament\Resources\PopupSubmissionResource\RelationManagers;
use App\Models\PopupSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PopupSubmissionResource extends Resource
{
    protected static ?string $model = PopupSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static ?string $navigationLabel = 'Popup Submissions';

    protected static ?string $modelLabel = 'Popup Submission';

    protected static ?string $pluralModelLabel = 'Popup Submissions';

    protected static ?string $navigationGroup = 'Marketing';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ip_address')
                    ->label('IP Address')
                    ->maxLength(255),
                Forms\Components\Toggle::make('emailed')
                    ->label('Processed')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('emailed')
                    ->label('Processed')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('emailed')
                    ->label('Processing Status'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('To Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('mark_processed')
                    ->label(fn (PopupSubmission $record): string => $record->emailed ? 'Mark Unprocessed' : 'Mark Processed')
                    ->icon(fn (PopupSubmission $record): string => $record->emailed ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (PopupSubmission $record): string => $record->emailed ? 'warning' : 'success')
                    ->action(function (PopupSubmission $record): void {
                        $record->update(['emailed' => !$record->emailed]);
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_processed')
                        ->label('Mark as Processed')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update(['emailed' => true]);
                            });
                        })
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_unprocessed')
                        ->label('Mark as Unprocessed')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update(['emailed' => false]);
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPopupSubmissions::route('/'),
            'create' => Pages\CreatePopupSubmission::route('/create'),
            'view' => Pages\ViewPopupSubmission::route('/{record}'),
            'edit' => Pages\EditPopupSubmission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

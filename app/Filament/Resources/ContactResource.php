<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    protected static ?string $navigationLabel = 'Contact Queries';
    
    protected static ?string $modelLabel = 'Contact Query';
    
    protected static ?string $pluralModelLabel = 'Contact Queries';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('username')
                    ->label('Name')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->disabled(),
                Forms\Components\Textarea::make('message')
                    ->label('Message')
                    ->rows(5)
                    ->disabled(),
                Forms\Components\TextInput::make('ip_address')
                    ->label('IP Address')
                    ->disabled(),
                Forms\Components\Toggle::make('emailed')
                    ->label('Email Sent')
                    ->disabled(),
                Forms\Components\TextInput::make('created_at')
                    ->label('Submitted At')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('username')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),
                Tables\Columns\IconColumn::make('emailed')
                    ->label('Email Sent')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('emailed')
                    ->label('Email Status')
                    ->placeholder('All')
                    ->trueLabel('Email Sent')
                    ->falseLabel('Email Failed'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Contact Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('username')
                            ->label('Name')
                            ->icon('heroicon-o-user'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-o-envelope')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('ip_address')
                            ->label('IP Address')
                            ->icon('heroicon-o-computer-desktop'),
                    ])->columns(3),
                Infolists\Components\Section::make('Message')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->label('')
                            ->html()
                            ->default('No message provided'),
                    ]),
                Infolists\Components\Section::make('Details')
                    ->schema([
                        Infolists\Components\IconEntry::make('emailed')
                            ->label('Email Sent')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Submitted At')
                            ->dateTime('F d, Y \a\t H:i:s'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('F d, Y \a\t H:i:s'),
                    ])->columns(3),
            ]);
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false;
    }
}

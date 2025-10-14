<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\BlogPost;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Blog Posts';

    protected static ?string $modelLabel = 'Blog Post';

    protected static ?string $pluralModelLabel = 'Blog Posts';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Blog Details')
                    ->schema([
                        Forms\Components\Fieldset::make('Titles')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->relationship('categories', 'name')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('sub_title')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('tag_id')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->relationship('tags', 'name')
                                    ->columnSpanFull(),
                            ]),
                        TiptapEditor::make('body')
                            ->profile('default')
                            ->disableFloatingMenus()
                            ->extraInputAttributes(['style' => 'max-height: 30rem; min-height: 24rem'])
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Fieldset::make('Feature Image')
                            ->schema([
                                Forms\Components\FileUpload::make('cover_photo_path')
                                    ->label('Cover Photo')
                                    ->disk(config('cloudflare.blog.disk', 'cloudflare'))
                                    ->directory(config('cloudflare.blog.directory', 'blog-images'))
                                    ->hint('This cover image is used in your blog post as a feature image. Recommended image size 1200 X 628')
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->maxSize(config('cloudflare.blog.max_size', 10240))
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'])
                                    ->rules('dimensions:max_width=1920,max_height=1004')
                                    ->required(),
                                Forms\Components\TextInput::make('photo_alt_text')->required(),
                            ])->columns(1),

                        Forms\Components\Fieldset::make('Status')
                            ->schema([
                                Forms\Components\ToggleButtons::make('status')
                                    ->inline()
                                    ->options([
                                        'published' => 'Published',
                                        'scheduled' => 'Scheduled',
                                        'pending' => 'Pending',
                                    ])
                                    ->required(),

                                Forms\Components\DateTimePicker::make('scheduled_for')
                                    ->visible(function ($get) {
                                        return $get('status') === 'scheduled';
                                    })
                                    ->required(function ($get) {
                                        return $get('status') === 'scheduled';
                                    })
                                    ->minDate(now()->addMinutes(5))
                                    ->native(false),
                            ]),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->nullable(false)
                            ->default(auth()->id()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_photo_path')
                    ->disk(config('cloudflare.blog.disk', 'cloudflare'))
                    ->label('Cover Image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'scheduled' => 'warning',
                        'pending' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                        'pending' => 'Pending',
                    ]),
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Author'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'view' => Pages\ViewBlogPost::route('/{record}'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}

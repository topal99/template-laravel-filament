<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Filament\Tables\View\TablesRenderHook;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //add field for image
                FileUpload::make('images'),
                //add field for title
                TextInput::make('title')
                ->required()
                ->placeholder('Enter Title'),
                //add field for subtitle
                TextInput::make('subtitle')
                ->required()
                ->placeholder('Enter Subtitle'),
                //add field for link1
                TextInput::make('link1')
                ->required()
                ->placeholder('Enter Link1'),
                //add field for link2
                TextInput::make('link2')
                ->required()
                ->placeholder('Enter Link2'),
                //add fiend toogle for is_active
                Toggle::make('is_active')
                ->default(false),
                ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                //add image column
                Tables\Columns\ImageColumn::make('images'),
                //add title column
                Tables\Columns\TextColumn::make('title')->wrap(),
                //add subtitle column
                Tables\Columns\TextColumn::make('subtitle')->wrap(),
                //add link1 column
                Tables\Columns\TextColumn::make('link1')->wrap(),
                //add link2 column
                Tables\Columns\TextColumn::make('link2')->wrap(),
                //add is_active column
                TextColumn::make('is_active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
                Tables\Actions\DeleteBulkAction::make(),

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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}

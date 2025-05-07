<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\AutorDocenteResource\Pages;
use App\Filament\Docentes\Resources\AutorDocenteResource\RelationManagers;
use Filament\Forms;
use App\Models\AutorProducto;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AutorDocenteResource extends Resource
{
    protected static ?string $model = AutorProducto::class;

    protected static ?string $navigationIcon ='heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('id_autor')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('id_producto')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('rol_autor')
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id_autor')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('id_producto')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('rol_autor')
                ->searchable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListAutorDocentes::route('/'),
            'create' => Pages\CreateAutorDocente::route('/create'),
            'edit' => Pages\EditAutorDocente::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource\Pages;
use App\Filament\Docentes\Resources\CuartilInvestigacionDocentesResource\RelationManagers;
use App\Models\CuartilInvestigacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CuartilInvestigacionDocentesResource extends Resource
{
    protected static ?string $model = CuartilInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_cuartil')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_cuartil')
                    ->searchable(),
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
            'index' => Pages\ListCuartilInvestigacionDocentes::route('/'),
            'create' => Pages\CreateCuartilInvestigacionDocentes::route('/create'),
            'edit' => Pages\EditCuartilInvestigacionDocentes::route('/{record}/edit'),
        ];
    }
}

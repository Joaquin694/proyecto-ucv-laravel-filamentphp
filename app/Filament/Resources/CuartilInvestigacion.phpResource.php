<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuartilInvestigacion.phpResource\Pages;
use App\Filament\Resources\CuartilInvestigacion.phpResource\RelationManagers;
use App\Models\CuartilInvestigacion.php;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CuartilInvestigacion.phpResource extends Resource
{
    protected static ?string $model = CuartilInvestigacion.php::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCuartilInvestigacion.phps::route('/'),
            'create' => Pages\CreateCuartilInvestigacion.php::route('/create'),
            'edit' => Pages\EditCuartilInvestigacion.php::route('/{record}/edit'),
        ];
    }
}

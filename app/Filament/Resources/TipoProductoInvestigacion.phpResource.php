<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoProductoInvestigacion.phpResource\Pages;
use App\Filament\Resources\TipoProductoInvestigacion.phpResource\RelationManagers;
use App\Models\TipoProductoInvestigacion.php;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoProductoInvestigacion.phpResource extends Resource
{
    protected static ?string $model = TipoProductoInvestigacion.php::class;

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
            'index' => Pages\ListTipoProductoInvestigacion.phps::route('/'),
            'create' => Pages\CreateTipoProductoInvestigacion.php::route('/create'),
            'edit' => Pages\EditTipoProductoInvestigacion.php::route('/{record}/edit'),
        ];
    }
}

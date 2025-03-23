<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LineaInvestigacionGeneral.phpResource\Pages;
use App\Filament\Resources\LineaInvestigacionGeneral.phpResource\RelationManagers;
use App\Models\LineaInvestigacionGeneral.php;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LineaInvestigacionGeneral.phpResource extends Resource
{
    protected static ?string $model = LineaInvestigacionGeneral.php::class;

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
            'index' => Pages\ListLineaInvestigacionGeneral.phps::route('/'),
            'create' => Pages\CreateLineaInvestigacionGeneral.php::route('/create'),
            'edit' => Pages\EditLineaInvestigacionGeneral.php::route('/{record}/edit'),
        ];
    }
}

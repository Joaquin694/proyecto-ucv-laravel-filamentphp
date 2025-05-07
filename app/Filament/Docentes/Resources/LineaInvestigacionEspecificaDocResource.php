<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource\Pages;
use App\Filament\Docentes\Resources\LineaInvestigacionEspecificaDocResource\RelationManagers;
use App\Models\LineaInvestigacionEspecifica;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LineaInvestigacionEspecificaDocResource extends Resource
{
    protected static ?string $model = LineaInvestigacionEspecifica::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nombre_linea_especifica')
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nombre_linea_especifica')
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
            'index' => Pages\ListLineaInvestigacionEspecificaDocs::route('/'),
            'create' => Pages\CreateLineaInvestigacionEspecificaDoc::route('/create'),
            'edit' => Pages\EditLineaInvestigacionEspecificaDoc::route('/{record}/edit'),
        ];
    }
}

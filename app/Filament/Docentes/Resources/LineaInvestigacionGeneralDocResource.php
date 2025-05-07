<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\LineaInvestigacionGeneralDocResource\Pages;
use App\Filament\Docentes\Resources\LineaInvestigacionGeneralDocResource\RelationManagers;
use App\Models\LineaInvestigacionGeneral;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LineaInvestigacionGeneralDocResource extends Resource
{
    protected static ?string $model = LineaInvestigacionGeneral::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_linea_general')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_linea_general')
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
            'index' => Pages\ListLineaInvestigacionGeneralDocs::route('/'),
            'create' => Pages\CreateLineaInvestigacionGeneralDoc::route('/create'),
            'edit' => Pages\EditLineaInvestigacionGeneralDoc::route('/{record}/edit'),
        ];
    }
}

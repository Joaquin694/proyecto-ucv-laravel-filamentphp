<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoInvestigacionResource\Pages;
use App\Filament\Resources\ProductoInvestigacionResource\RelationManagers;
use App\Models\ProductoInvestigacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoInvestigacionResource extends Resource
{
    protected static ?string $model = ProductoInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_tipo_producto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('titulo_producto')
                    ->required(),
                Forms\Components\TextInput::make('id_estado')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_cuartil')
                    ->numeric(),
                Forms\Components\TextInput::make('doi_url'),
                Forms\Components\DatePicker::make('fecha_publicacion'),
                Forms\Components\TextInput::make('id_linea_general')
                    ->numeric(),
                Forms\Components\TextInput::make('id_linea_especifica')
                    ->numeric(),
                Forms\Components\Textarea::make('principal_resultado')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('pdf_nombre'),
                Forms\Components\TextInput::make('pdf_file'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_tipo_producto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo_producto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_estado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_cuartil')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doi_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_publicacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_linea_general')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_linea_especifica')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pdf_nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pdf_file')
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
            'index' => Pages\ListProductoInvestigacions::route('/'),
            'create' => Pages\CreateProductoInvestigacion::route('/create'),
            'edit' => Pages\EditProductoInvestigacion::route('/{record}/edit'),
        ];
    }
}

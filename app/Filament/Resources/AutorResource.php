<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutorResource\Pages;
use App\Models\Autor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class AutorResource extends Resource
{
    protected static ?string $model = Autor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campo para el nombre del autor
                Forms\Components\TextInput::make('nombre_autor')
                    ->label('Nombre del Autor')
                    ->required()
                    ->maxLength(150),
                // Campo para el email
                Forms\Components\TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Campo para la contraseña. Se oculta en edición para no modificarla accidentalmente.
                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                    ->hiddenOn('edit'),
                // Campo para seleccionar el rol
                Forms\Components\Select::make('role')
                    ->label('Rol')
                    ->options([
                        'Investigador' => 'Investigador',
                        'Admin' => 'Admin',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Columna de ID
                Tables\Columns\TextColumn::make('id_autor')
                    ->label('ID')
                    ->sortable(),
                // Columna para el nombre
                Tables\Columns\TextColumn::make('nombre_autor')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                // Columna para el correo
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->sortable()
                    ->searchable(),
                // Columna para el rol
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->sortable()
                    ->searchable(),
                // Columna para la fecha de creación
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Si deseas gestionar relaciones (por ejemplo, productos asociados), agrégalas aquí.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAutors::route('/'),
            'create' => Pages\CreateAutor::route('/create'),
            'edit'   => Pages\EditAutor::route('/{record}/edit'),
        ];
    }
}

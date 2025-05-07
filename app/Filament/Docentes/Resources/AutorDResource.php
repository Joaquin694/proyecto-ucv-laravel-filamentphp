<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\AutorDResource\Pages;
use App\Models\Autor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class AutorDResource extends Resource
{
    protected static ?string $model = Autor::class;

    protected static ?string $navigationIcon ='heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_autor')
                    ->label('Nombre del Autor')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                    ->hiddenOn('edit'),
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
                Tables\Columns\TextColumn::make('id_autor')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_autor')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Se eliminó la acción de editar
            ])
            ->bulkActions([
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
            'index' => Pages\ListAutorDS::route('/'),
            'create' => Pages\CreateAutorD::route('/create'),
            // Se eliminó la ruta de edición
        ];
    }
}

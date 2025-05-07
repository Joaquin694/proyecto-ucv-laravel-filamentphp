<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutorProductoResource\Pages;
use Filament\Forms;
use App\Models\AutorProducto;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AutorProductoResource extends Resource
{
    protected static ?string $model = AutorProducto::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_autor')
                    ->relationship('autor', 'nombre_autor')  // Relación con Autor
                    ->required()
                    ->label('Autor'),

                Forms\Components\Select::make('id_producto')
                    ->relationship('productoInvestigacion', 'titulo_producto')  // Relación con Producto
                    ->required()
                    ->label('Producto'),

                Forms\Components\Select::make('rol_autor')
                    ->options([
                        'Principal' => 'Principal',
                        'Coautor' => 'Coautor',
                    ])
                    ->required()
                    ->label('Rol del Autor'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query
                    ->join('producto_investigacion', 'autor_producto.id_producto', '=', 'producto_investigacion.id_producto')
                    ->join('autores', 'autor_producto.id_autor', '=', 'autores.id_autor')
                    ->select('autor_producto.*', 'producto_investigacion.titulo_producto as producto_nombre', 'autores.nombre_autor as autor_nombre');
            })
            ->columns([
                Tables\Columns\TextColumn::make('autor_nombre')
                    ->label('Autor')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('autores.nombre_autor', 'like', "%{$search}%");
                    }),

                Tables\Columns\TextColumn::make('rol_autor')
                    ->label('Rol')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Principal' => 'primary',
                        'Coautor' => 'success',
                    }),

                Tables\Columns\TextColumn::make('producto_nombre')
                    ->label('Producto')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->orWhere('producto_investigacion.titulo_producto', 'like', "%{$search}%");
                    }),
            ])
            ->groups([
                Tables\Grouping\Group::make('producto_nombre')
                    ->label('Producto de Investigación')
                    ->getTitleFromRecordUsing(fn ($record) => $record->producto_nombre)  // <- Aquí forzamos el nombre del group
                    ->collapsible(true)
                    ->titlePrefixedWithLabel(false),
            ])
            ->defaultGroup('producto_nombre')
            ->defaultSort('producto_nombre')
            ->actions([
                Tables\Actions\DeleteAction::make()
                ->label('Eliminar')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function ($record) {
                    AutorProducto::where('id_autor', $record->id_autor)
                                 ->where('id_producto', $record->id_producto)
                                 ->delete();
                })
            ])
            ->bulkActions([])
            ->searchDebounce(500);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAutorProductos::route('/'),
            'create' => Pages\CreateAutorProducto::route('/create'),
        ];
    }
}

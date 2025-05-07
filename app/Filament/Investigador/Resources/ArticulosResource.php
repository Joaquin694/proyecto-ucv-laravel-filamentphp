<?php

namespace App\Filament\Investigador\Resources;

use App\Filament\Investigador\Resources\ArticulosResource\Pages;
use App\Models\Grado;
use App\Models\TipoProductoInvestigacion;
use App\Models\EstadoInvestigacion;
use App\Models\ProductoInvestigacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticulosResource extends Resource
{
    protected static ?string $model = ProductoInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Artículos';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Artículo';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Artículos';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_tipo_producto')
                ->label('Tipo Producto')
                ->options(fn () => TipoProductoInvestigacion::pluck('nombre_tipo_producto', 'id_tipo_producto'))
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('titulo_producto')
                ->required(),

            Forms\Components\Select::make('id_estado')
                ->label('Estado')
                ->options(fn () => EstadoInvestigacion::pluck('nombre_estado', 'id_estado'))
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('url')->label('URL'),

            Forms\Components\DatePicker::make('fecha_publicacion')
                ->label('Fecha de Publicación')
                ->required(),

            Forms\Components\Select::make('id_grado')
                ->label('Grado')
                ->options(fn () => Grado::all()->mapWithKeys(fn ($item) => [
                    $item->id_grado => trim(($item->tipo ?? '') . ' ' . ($item->curso ?? '') . ' ' . ($item->ciclo ?? '')) ?: 'Sin dato'
                ]))
                ->searchable(),

            Forms\Components\Textarea::make('principal_resultado')->columnSpanFull(),

            Forms\Components\FileUpload::make('pdf_nombre')
                ->label('PDF')
                ->disk('public')
                ->directory('pdfs')
                ->acceptedFileTypes(['application/pdf'])
                ->preserveFilenames(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipoProducto.nombre_tipo_producto')->label('Tipo Producto')->sortable(),
                Tables\Columns\TextColumn::make('titulo_producto')->searchable(),
                Tables\Columns\TextColumn::make('estado.nombre_estado')->label('Estado')->sortable(),
                Tables\Columns\TextColumn::make('url')->label('URL')->searchable(),
                Tables\Columns\TextColumn::make('fecha_publicacion')->date()->label('Fecha de Publicación')->sortable(),
                Tables\Columns\TextColumn::make('grado.tipo')->label('Grado')->sortable(),
                Tables\Columns\TextColumn::make('pdf_nombre')->label('PDF')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('Ver PDF')
                ->visible(fn ($record) => !empty($record->pdf_nombre))
                ->url(fn ($record) => asset('storage/' . $record->pdf_nombre), true) // Cambié esto
                ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $userId = Auth::id();

                $query->whereHas('autores', function ($q) use ($userId) {
                    $q->where('autor_producto.id_autor', $userId)
                      ->whereIn('autor_producto.rol_autor', ['Principal', 'Coautor']);
                });

                $query->whereHas('tipoProducto', function ($q) {
                    $q->where('nombre_tipo_producto', 'LIKE', '%Artículo%');
                });
            });
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticulos::route('/'),
            'create' => Pages\CreateArticulos::route('/create'),
            'edit' => Pages\EditArticulos::route('/{record}/edit'),
        ];
    }
}

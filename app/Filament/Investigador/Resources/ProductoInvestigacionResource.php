<?php

namespace App\Filament\Investigador\Resources;

use App\Filament\Investigador\Resources\ProductoInvestigacionResource\Pages;
use App\Models\ProductoInvestigacion;
use App\Models\AutorProducto;  // Importar el modelo AutorProducto
use Filament\Forms;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Grado;
use App\Models\TipoProductoInvestigacion;
use App\Models\EstadoInvestigacion;
use App\Models\CuartilInvestigacion;
use App\Models\LineaInvestigacionGeneral;
use App\Models\LineaInvestigacionEspecifica;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductoInvestigacionResource extends Resource
{
    protected static ?string $model = ProductoInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('id_tipo_producto')
                    ->label('Tipo Producto')
                    ->options(
                        TipoProductoInvestigacion::all()->pluck('nombre_tipo_producto', 'id_tipo_producto')
                    )
                    ->searchable(),
                Forms\Components\TextInput::make('titulo_producto')
                ->required()
                ->label('Título del Producto')
                ->rules(['unique:producto_investigacion,titulo_producto'])
                ->validationMessages([
                    'unique' => 'Ya existe un producto de investigación con este título.',
                ]),
                Forms\Components\Select::make('id_estado')
                    ->label('Estado')
                    ->options(
                        EstadoInvestigacion::all()->pluck('nombre_estado', 'id_estado')
                    )
                    ->searchable(),
                Forms\Components\Select::make('id_cuartil')
                    ->label('Cuartil')
                    ->options(
                        CuartilInvestigacion::all()->pluck('nombre_cuartil', 'id_cuartil')
                    )
                    ->searchable(),
                Forms\Components\TextInput::make('doi_url'),
                Forms\Components\DatePicker::make('fecha_publicacion'),
                Forms\Components\Select::make('id_linea_general')
                    ->label('Línea General')
                    ->options(
                        LineaInvestigacionGeneral::all()->pluck('nombre_linea_general', 'id_linea_general')
                    )
                    ->searchable(),
                Forms\Components\Select::make('id_linea_especifica')
                    ->label('Línea Específica')
                    ->options(
                        LineaInvestigacionEspecifica::all()->pluck('nombre_linea_especifica', 'id_linea_especifica')
                    )
                    ->searchable(),
                Forms\Components\Select::make('id_grado')
                    ->label('Grado')
                    ->options(
                        Grado::all()->mapWithKeys(function ($item) {
                            $label = trim(($item->tipo ?? '') . ' ' . ($item->curso ?? '') . ' ' . ($item->ciclo ?? ''));
                            return [$item->id_grado => $label ?: 'Sin dato'];
                        })
                    )
                    ->searchable(),
                Forms\Components\Textarea::make('principal_resultado')
                    ->columnSpanFull(),
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
            ->query(self::getFilteredQuery())
            ->columns([
                Tables\Columns\TextColumn::make('tipoProducto.nombre_tipo_producto')
                    ->label('Tipo Producto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo_producto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado.nombre_estado')
                    ->label('Estado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cuartil.nombre_cuartil')
                    ->label('Cuartil')
                    ->sortable(),
                Tables\Columns\TextColumn::make('doi_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_publicacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lineaGeneral.nombre_linea_general')
                    ->label('Línea General')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lineaEspecifica.nombre_linea_especifica')
                    ->label('Línea Específica')
                    ->sortable(),
                Tables\Columns\TextColumn::make('grado.tipo')
                    ->label('Grado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pdf_nombre')
                    ->label('PDF')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('Ver PDF')
                    ->action(function ($record) {
                        if ($record->pdf_nombre) {
                            $url = asset('storage/' . $record->pdf_nombre);
                            return redirect()->to($url);
                        }
                        session()->flash('error', 'No se ha cargado un PDF para este registro.');
                    })
                    ->icon('heroicon-o-eye'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductoInvestigacions::route('/'),
            'create' => Pages\CreateProductoInvestigacion::route('/create'),
            'edit' => Pages\EditProductoInvestigacion::route('/{record}/edit'),
        ];
    }

    public static function getFilteredQuery()
    {
        $user = Auth::user();

        // Si el usuario tiene un id_autor válido, filtramos por autor
        if ($user && $user->id_autor) {
            $idAutor = $user->id_autor;

            return ProductoInvestigacion::query()
                ->whereHas('autores', function ($query) use ($idAutor) {
                    $query->where('autor_producto.id_autor', $idAutor);
                })
                // Agregamos este ->orWhere para permitir que al menos se muestre algo aunque no tenga aún productos
                ->orWhereDoesntHave('autores');
        }

        // Si no tiene id_autor, simplemente devolvemos todos los productos (o puedes adaptar)
        return ProductoInvestigacion::query();
    }

}

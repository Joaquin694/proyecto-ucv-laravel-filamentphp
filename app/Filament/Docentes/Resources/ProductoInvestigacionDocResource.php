<?php

namespace App\Filament\Docentes\Resources;

use App\Filament\Docentes\Resources\ProductoInvestigacionDocResource\Pages;
use App\Filament\Docentes\Resources\ProductoInvestigacionDocResource\RelationManagers;
use App\Models\ProductoInvestigacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Grado;
use App\Models\TipoProductoInvestigacion;
use App\Models\EstadoInvestigacion;
use App\Models\CuartilInvestigacion;
use App\Models\LineaInvestigacionGeneral;
use App\Models\LineaInvestigacionEspecifica;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoInvestigacionDocResource extends Resource
{
    protected static ?string $model = ProductoInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {return $form
        ->schema([
            // Selección del Tipo Producto usando el valor correcto del modelo
            Forms\Components\Select::make('id_tipo_producto')
                ->label('Tipo Producto')
                ->options(
                    TipoProductoInvestigacion::all()->pluck('nombre_tipo_producto', 'id_tipo_producto')
                )
                ->searchable(),
            Forms\Components\TextInput::make('titulo_producto')
                ->required(),
            // Selección del Estado usando la relación
            Forms\Components\Select::make('id_estado')
                ->label('Estado')
                ->options(
                    EstadoInvestigacion::all()->pluck('nombre_estado', 'id_estado')
                )
                ->searchable(),
            // Selección del Cuartil
            Forms\Components\Select::make('id_cuartil')
                ->label('Cuartil')
                ->options(
                    CuartilInvestigacion::all()->pluck('nombre_cuartil', 'id_cuartil')
                )
                ->searchable(),
            Forms\Components\TextInput::make('doi_url'),
            Forms\Components\DatePicker::make('fecha_publicacion'),
            // Selección de Línea General
            Forms\Components\Select::make('id_linea_general')
                ->label('Línea General')
                ->options(
                    LineaInvestigacionGeneral::all()->pluck('nombre_linea_general', 'id_linea_general')
                )
                ->searchable(),
            // Selección de Línea Específica
            Forms\Components\Select::make('id_linea_especifica')
                ->label('Línea Específica')
                ->options(
                    LineaInvestigacionEspecifica::all()->pluck('nombre_linea_especifica', 'id_linea_especifica')
                )
                ->searchable(),
            // Selección de Grado (opción combinada si así lo prefieres)
            Forms\Components\Select::make('id_grado')
                ->label('Grado')
                ->options(
                    Grado::all()->mapWithKeys(function ($item) {
                        // Combina tipo, curso y ciclo para mostrar una etiqueta completa
                        $label = trim(($item->tipo ?? '') . ' ' . ($item->curso ?? '') . ' ' . ($item->ciclo ?? ''));
                        return [$item->id_grado => $label ?: 'Sin dato'];
                    })
                )
                ->searchable(),
            Forms\Components\Textarea::make('principal_resultado')
                ->columnSpanFull(),
            // Componente para subir el PDF
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
            // Muestra el nombre del Tipo Producto a través de la relación
            Tables\Columns\TextColumn::make('tipoProducto.nombre_tipo_producto')
                ->label('Tipo Producto')
                ->sortable(),
            Tables\Columns\TextColumn::make('titulo_producto')
                ->searchable(),
            // Muestra el nombre del Estado
            Tables\Columns\TextColumn::make('estado.nombre_estado')
                ->label('Estado')
                ->sortable(),
            // Muestra el Cuartil
            Tables\Columns\TextColumn::make('cuartil.nombre_cuartil')
                ->label('Cuartil')
                ->sortable(),
            Tables\Columns\TextColumn::make('doi_url')
                ->searchable(),
            Tables\Columns\TextColumn::make('fecha_publicacion')
                ->date()
                ->sortable(),
            // Muestra el nombre de la Línea General
            Tables\Columns\TextColumn::make('lineaGeneral.nombre_linea_general')
                ->label('Línea General')
                ->sortable(),
            // Muestra el nombre de la Línea Específica
            Tables\Columns\TextColumn::make('lineaEspecifica.nombre_linea_especifica')
                ->label('Línea Específica')
                ->sortable(),
            // Muestra el Grado (en este caso, el campo "tipo" de la relación)
            Tables\Columns\TextColumn::make('grado.tipo')
                ->label('Grado')
                ->sortable(),
            // Puedes optar por ocultar el campo pdf_nombre o usarlo en una acción
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
        ->filters([
            //
        ])
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
    return [
        //
    ];
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductoInvestigacionDocs::route('/'),
            'create' => Pages\CreateProductoInvestigacionDoc::route('/create'),
            'edit' => Pages\EditProductoInvestigacionDoc::route('/{record}/edit'),
        ];
    }
}

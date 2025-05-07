<?php

namespace App\Filament\Investigador\Resources;

use App\Filament\Investigador\Resources\PatenteResource\Pages;
use App\Filament\Investigador\Resources\PatenteResource\RelationManagers;
use App\Models\ProductoInvestigacion;
use App\Models\Grado;
use App\Models\TipoProductoInvestigacion;
use App\Models\EstadoInvestigacion;
use App\Models\CuartilInvestigacion;
use App\Models\LineaInvestigacionGeneral;
use App\Models\LineaInvestigacionEspecifica;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth; // asegúrate de importar esto

class PatenteResource extends Resource
{
    protected static ?string $model = ProductoInvestigacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Patente';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Patentes';
    }

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
                    ->required(),
                Forms\Components\Select::make('id_estado')
                    ->label('Estado')
                    ->options(
                        EstadoInvestigacion::all()->pluck('nombre_estado', 'id_estado')
                    )
                    ->searchable(),
                Forms\Components\DatePicker::make('fecha_publicacion')
                    ->label('Fecha de entrega'),
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
        ->modifyQueryUsing(function (Builder $query) {
            $userId = Auth::id();

            // Filtro para mostrar productos asociados con el autor actual
            $query->whereHas('autores', function ($q) use ($userId) {
                $q->where('autor_producto.id_autor', $userId)
                    ->whereIn('autor_producto.rol_autor', ['Principal', 'Coautor']);
            });

            // Filtrar solo los productos que son tipo PATENTE
            $query->whereHas('tipoProducto', function ($q) {
                $q->where('nombre_tipo_producto', 'LIKE', '%PATENTE%');
            });
        })
        ->columns([
            Tables\Columns\TextColumn::make('tipoProducto.nombre_tipo_producto')->label('Tipo Producto')->sortable(),
            Tables\Columns\TextColumn::make('titulo_producto')->searchable(),
            Tables\Columns\TextColumn::make('estado.nombre_estado')->label('Estado')->sortable(),
            Tables\Columns\TextColumn::make('fecha_publicacion')->date()->label('Fecha de entrega')->sortable(),
            Tables\Columns\TextColumn::make('lineaGeneral.nombre_linea_general')->label('Línea General')->sortable(),
            Tables\Columns\TextColumn::make('lineaEspecifica.nombre_linea_especifica')->label('Línea Específica')->sortable(),
            Tables\Columns\TextColumn::make('grado.tipo')->label('Grado')->sortable(),
            Tables\Columns\TextColumn::make('pdf_nombre')->label('PDF')->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('id_tipo_producto')
                ->label('Tipo Producto')
                ->options(
                    TipoProductoInvestigacion::where('nombre_tipo_producto', 'LIKE', '%PATENTE%')
                        ->pluck('nombre_tipo_producto', 'id_tipo_producto')
                )
                ->default(
                    TipoProductoInvestigacion::where('nombre_tipo_producto', 'LIKE', '%PATENTE%')
                        ->first()
                        ->id_tipo_producto ?? null
                )
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
            'index' => Pages\ListPatentes::route('/'),
            'create' => Pages\CreatePatente::route('/create'),
            'edit' => Pages\EditPatente::route('/{record}/edit'),
        ];
    }
}

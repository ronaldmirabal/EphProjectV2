<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InventoryExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Inventory::with('people','area','brand','typeproduct')->get();
    }

    public function map($inventory): array
    {
        return [
            $inventory->id,
            $inventory->stock,
            $inventory->description,
            $inventory->typeproduct->name,
            $inventory->brand->name,
            $inventory->model,
            $inventory->serial,
            $inventory->noplaca,
            $inventory->people->first_name. " ".$inventory->people->last_name,
            $inventory->area->name,
        ];
    }
    public function headings(): array{
        return [
            '#Identificador',
            'Cantidad',
            'Descripción',
            'Tipo de Articulo',
            'Marca',
            'Modelo',
            'Serial',
            'NoPlaca',
            'Asignado',
            'Área'

        ];
    }

}

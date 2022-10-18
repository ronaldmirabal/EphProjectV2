<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class InventoryExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Inventory::with('people','area','brand','typeproduct')
        ->where('active', '=', true)->get();
    }

    public function registerEvents(): array
    {
        
        $styleArray = [
            'font' => [
                'bold' => true,
                ]
        ];
            
        
        
        return [
            AfterSheet::class    => function(AfterSheet $event) use ($styleArray)
            {
                $cellRange = 'A1:L1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
           

                $event->getSheet()->getDelegate()->getStyle('A1:G1')->applyFromArray($styleArray);						

            },
        ];
    }

    public function map($inventory): array
    {
        return [
            $inventory->people->first_name. " ".$inventory->people->last_name,
            $inventory->people->position->name,
            $inventory->area->name,
            $inventory->noplaca,
            $inventory->typeproduct->name,
            $inventory->color,
            $inventory->brand->name,
            $inventory->model,
            $inventory->serial,
            $inventory->description,
        ];
    }
    public function headings(): array{
        
        return [
            'Responsable',
            'Cargo',
            'Departamento O Dependencia ',
            'Placa Número',
            'Descripción',
            'Color',
            'Marca',
            'Modelo',
            'Serial',
            'Observación'

        ];
    }

}

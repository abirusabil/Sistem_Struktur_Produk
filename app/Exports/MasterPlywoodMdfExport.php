<?php

namespace App\Exports;

use App\Models\MasterPlywoodMdf;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MasterPlywoodMdfExport implements FromCollection , WithHeadings, WithMapping ,ShouldAutoSize ,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $num = 1;
    public function collection()
    {
        $data = MasterPlywoodMdf::with('suplier')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'Kode',
            'Nama',
            'Tebal',
            'Lebar',
            'Panjang',
            'Luas',
            'Harga/Lembar',
            'Harga/M2',
            'Satuan',
            'Suplier'
        ];
    }

    public function map($data): array
    {
        
        return [
            $this->num++,
            $data->id,
            $data->Nama_Plywood_MDF,
            $data->Tebal_Plywood_MDF,
            $data->Panjang_Plywood_MDF,
            $data->Lebar_Plywood_MDF,
            $data->Panjang_Plywood_MDF *  $data->Lebar_Plywood_MDF /1000000,
            number_format($data->Harga_Plywood_MDF, 2, '.', ','),
            number_format($data->Harga_Plywood_MDF/($data->Panjang_Plywood_MDF *  $data->Lebar_Plywood_MDF /1000000)*1.2, 2, '.', ','),
            $data->Satuan_Plywood_MDF,
            $data->suplier->nama_suplier
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        

        $sheet->getStyle('A1:K1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:K' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
        return [
            1    => [
                    'font' =>   [
                        'bold' => true ,
                        'size' => 12 
                       
                    ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'E0F709',
                    ],
                ],
            ],
            
            
        ];
    }
}

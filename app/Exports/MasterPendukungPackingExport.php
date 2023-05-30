<?php

namespace App\Exports;

use App\Models\MasterPendukungPacking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class MasterPendukungPackingExport implements FromCollection , WithHeadings , WithMapping ,WithStyles,ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $num = 1;
    public function collection()
    {
        $data = MasterPendukungPacking::with('Suplier')->get();
        return $data;
    }

    public function headings(): array
    {
        return 
        [
            '#',
            'Kode',
            'Pendukung Packing',
            'Tebal',
            'Lebar',
            'Panjang',
            'Luas',
            'Satuan',
            'Harga',
            'Harga/M2',
            'Suplier'
        ];

        
    }

    public function map($data): array
    {
        
        return [
            $this->num++,
            $data->id,
            $data->Nama_Pendukung_Packing,
            $data->Tebal_Pendukung_Packing,
            $data->Lebar_Pendukung_Packing,
            $data->Panjang_Pendukung_Packing,
            $data->Lebar_Pendukung_Packing * $data->Panjang_Pendukung_Packing / 1000000,
            $data->Satuan_Pendukung_Packing,
            number_format($data->Harga_Pendukung_Packing, 2, '.', ','),
            ($data->Satuan_Pendukung_Packing == "Meter")
                ? number_format($data->Harga_Pendukung_Packing / ($data->Panjang_Pendukung_Packing * $data->Lebar_Pendukung_Packing / 1000000), 2, '.', ',')
                : "-",
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

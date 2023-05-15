<?php

namespace App\Exports;

use App\Models\Suplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class SuplierExport implements FromCollection , WithHeadings , ShouldAutoSize ,WithStyles 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Suplier::select('Id','Nama_Suplier','Alamat_Suplier','Kontak_Suplier')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nama Suplier',
            'Alamat Suplier',
            'Kontak Suplier'
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
        

        $sheet->getStyle('A1:D1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:D' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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


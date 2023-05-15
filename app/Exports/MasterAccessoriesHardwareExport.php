<?php

namespace App\Exports;

use App\Models\MasterAccessoriesHardware;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MasterAccessoriesHardwareExport implements FromCollection , WithHeadings, WithMapping ,ShouldAutoSize ,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $num = 1;
    public function collection()
    {
        $data = MasterAccessoriesHardware::with('Suplier')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'no',
            'Kode',
            'Accessories Hardware',
            'Ukuran',
            'Satuan',
            'Harga',
            'Suplier',
        ];
    }

    public function map($data): array
    {
        
        return [
            $this->num++,
            $data->id,
            $data->Nama_Accessories_Hardware,
            $data->Ukuran_Accessories_Hardware,
            $data->Satuan_Accessories_Hardware,
            number_format($data->Harga_Accessories_Hardware, 2, '.', ','),
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
        

        $sheet->getStyle('A1:G1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

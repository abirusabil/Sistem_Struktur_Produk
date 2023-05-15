<?php

namespace App\Exports;

use App\Models\MasterKayu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class MasterKayuExport implements FromCollection , WithHeadings, WithMapping ,ShouldAutoSize ,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $num = 1;
    public function collection()
    {
        $data = MasterKayu::with('suplier')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'np',
            'Kode',
            'Kayu',
            'Satuan',
            'Harga',
            'Suplier'
        ];
    }

    public function map($data): array
    {
        
        return [
            $this->num++,
            $data->id,
            $data->Nama_Kayu,
            $data->Satuan,
            number_format($data->Harga_Kayu ,2, '.', ','),
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
        

        $sheet->getStyle('A1:F1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:F' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ItemExport implements FromCollection , WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $num = 1;
    public function collection()
    {
        $data = Item::with('Collection.Buyer')->get();
        return $data;
    }

    public function headings(): array
    {
       return [
                'No',
                'Kode',
                'Item',
                'Tinggi',
                'Lebar',
                'Panjang',
                'Berat',
                'Warna',
                'Collection',
                'Buyer'
       ];
    }

    public function map($data): array
    {
        return [
            $this->num++,
            $data->id,
            $data->Nama_Item,
            $data->Tinggi_Item,
            $data->Lebar_Item,
            $data->Panjang_Item,
            $data->Berat_Item,
            $data->Warna_Item,
            $data->Collection->Nama_Collection,
            $data->Collection->Buyer->Nama_Buyer,

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
        

        $sheet->getStyle('A1:J1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:J' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

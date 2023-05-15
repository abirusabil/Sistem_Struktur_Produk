<?php

namespace App\Exports;

use App\Models\KebutuhanKartonBoxItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKartonBoxItemExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
{
    use Exportable;

    protected $itemId;
    private $num = 1;

    public function __construct($itemId)
    {
        $this->itemId = $itemId;
    }

    public function collection()
    {
        $data = KebutuhanKartonBoxItem::with('Item')
            ->where('Item_id', $this->itemId)
            ->get();
        return $data;

    }

    public function headings(): array
    {
        return [
            'Kode Item',
            'Item',
            'No',
            'Kode Cutting',
            'Jenis',
            'Keterangan',
            'Tinggi',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Harga Satuan',
            'Total_Biaya'
        ];
    }

    public function map($data): array
    {
        return [
            $data->Item_Id,
            $data->item->Nama_Item,
            $this->num++,
            $data->id,
            $data->Jenis_Kebutuhan_Karton_Box,
            $data->Keterangan_Kebutuhan_Karton_Box_Item,
            $data->Tinggi_Kebutuhan_Karton_Box_Item,
            $data->Lebar_Kebutuhan_Karton_Box_Item,
            $data->Panjang_Kebutuhan_Karton_Box_Item,
            $data->Quantity_Kebutuhan_Karton_Box_Item,
            number_format($data->Harga_Kebutuhan_Karton_Box_Item,2,'.',','),
            number_format($data->Harga_Kebutuhan_Karton_Box_Item 
                            *  $data->Quantity_Kebutuhan_Karton_Box_Item ,2,'.',',')

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
        

        $sheet->getStyle('A1:L1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:L' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

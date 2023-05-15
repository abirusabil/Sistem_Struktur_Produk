<?php

namespace App\Exports;

use App\Models\KebutuhanAccessoriesHardwareItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanAccessoriesHardwareItemExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanAccessoriesHardwareItem::with('Item', 'MasterAccessoriesHardware')
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
            'Kode Accessories Hardware',
            'Accessories Hardware',
            'Keterangan',
            'Ukuran',
            'Quantity',
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
            $data->Accessories_Hardware_Id,
            $data->MasterAccessoriesHardware->Nama_Accessories_Hardware,
            $data->Keterangan_Kebutuhan_Accessories_Hardware_Item,
            $data->MasterAccessoriesHardware->Ukuran_Accessories_Hardware,
            $data->Quantity_Kebutuhan_Accessories_Hardware_Item,
            number_format($data->MasterAccessoriesHardware->Harga_Accessories_Hardware,2,'.',','),
            number_format($data->MasterAccessoriesHardware->Harga_Accessories_Hardware 
                            *  $data->Quantity_Kebutuhan_Accessories_Hardware_Item ,2,'.',',')

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

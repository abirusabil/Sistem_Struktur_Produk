<?php

namespace App\Exports;

use App\Models\KebutuhanKomponenFinishingItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKomponenFinishingItemExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanKomponenFinishingItem::with('Item', 'MasterKomponenFinishing')
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
            'Kode Komponen Finishing',
            'Komponen Finishing',
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
            $data->Komponen_Finishing_Id,
            $data->MasterKomponenFinishing->Nama_Komponen_Finishing,
            $data->Quantity_Kebutuhan_Komponen_Finishing_Item,
            number_format(
                $data->MasterKomponenFinishing->Harga_Komponen_Finishing / $data->MasterKomponenFinishing->Quantity_Komponen_Finishing
                ,2,'.',','),
            number_format($data->MasterKomponenFinishing->Harga_Komponen_Finishing 
                            *  $data->Quantity_Kebutuhan_Komponen_Finishing_Item 
                            / $data->MasterKomponenFinishing->Quantity_Komponen_Finishing
                        ,2,'.',',')

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
        

        $sheet->getStyle('A1:I1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

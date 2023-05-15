<?php

namespace App\Exports;

use App\Models\KebutuhanKayuItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKayuItemExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanKayuItem::with('Item', 'MasterKayu')
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
            'Kode Kayu',
            'Kayu',
            'KP',
            'Keterangan',
            'Grade',
            'Tebal',
            'Lebar',
            'Panjang',
            'Panjang Bruto',
            'Quantity',
            'Volume Netto',
            'Volume Bruto',
            'Harga Kayu/M3',
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
            $data->Kayu_Id,
            $data->masterkayu->Nama_Kayu,
            $data->KP_Kebutuhan_Kayu_Item,
            $data->Keterangan_Kebutuhan_Kayu_Item,
            $data->Grade_Kebutuhan_Kayu_Item,
            $data->Tebal_Kebutuhan_Kayu_Item,
            $data->Lebar_Kebutuhan_Kayu_Item,
            $data->Panjang_Kebutuhan_Kayu_Item,
            $data->Panjang_Kebutuhan_Kayu_Item+20,
            $data->Quantity_Kebutuhan_Kayu_Item,
            number_format($data->Tebal_Kebutuhan_Kayu_Item*
            ($data->Panjang_Kebutuhan_Kayu_Item+20)*
            $data->Lebar_Kebutuhan_Kayu_Item/1000000000,4,'.',','),
            number_format(($data->Tebal_Kebutuhan_Kayu_Item +5)*
            (($data->Panjang_Kebutuhan_Kayu_Item+20)*1.1)*
            ($data->Lebar_Kebutuhan_Kayu_Item+10)/1000000000,4,'.',','),
            number_format($data->masterkayu->Harga_Kayu,2,'.',','),
            number_format((
                ($data->Tebal_Kebutuhan_Kayu_Item +5)*
                (($data->Panjang_Kebutuhan_Kayu_Item+20)*1.1)*
                ($data->Lebar_Kebutuhan_Kayu_Item+10)/1000000000
            )* $data->masterkayu->Harga_Kayu,2,'.',',')

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
        

        $sheet->getStyle('A1:R1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:R' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

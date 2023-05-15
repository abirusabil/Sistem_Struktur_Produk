<?php

namespace App\Exports;

use App\Models\KebutuhanPlywoodMDFItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KebutuhanPlywoodMDFItemExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $itemId;
    private $num = 1;

    public function __construct($itemId)
    {
        $this->itemId = $itemId;
    }

    public function collection()
    {
        $data = KebutuhanPlywoodMDFItem::with('Item', 'MasterPlywoodMDF')
            ->where('Item_Id', $this->itemId)->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Kode Item',
            'Item',
            'No',
            'Kode Cutting',
            'Kode Material',
            'Material',
            'Kp',
            'Keterangan',
            'Grade',
            'Tebal',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Total M2',
            'Biaya /M2',
            'Total Biaya'
        ];
    }

    public function map($data): array
    {
        return [
            $data->Item_Id,
            $data->Item->Nama_Item,
            $this->num++,
            $data->id,
            $data->Plywood_MDF_Id,
            $data->MasterPlywoodMDF->Nama_Plywood_MDF,
            $data->KP_Kebutuhan_Plywood_MDF_Item,
            $data->Keterangan_Kebutuhan_Plywood_MDF_Item,
            $data->Grade_Kebutuhan_Plywood_MDF_Item,
            $data->MasterPlywoodMDF->Tebal_Plywood_MDF,
            $data->Lebar_Kebutuhan_Plywood_MDF_Item,
            $data->Panjang_Kebutuhan_Plywood_MDF_Item,
            $data->Quantity_Kebutuhan_Plywood_MDF_Item,
            number_format(
                $data->Panjang_Kebutuhan_Plywood_MDF_Item *
                    $data->Lebar_Kebutuhan_Plywood_MDF_Item / 1000000 *
                    $data->Quantity_Kebutuhan_Plywood_MDF_Item,
                4,
                '.'
            ),
            number_format(
                $data->MasterPlywoodMDF->Harga_Plywood_MDF /
                    ($data->MasterPlywoodMDF->Panjang_Plywood_MDF
                        * $data->MasterPlywoodMDF->Lebar_Plywood_MDF / 1000000
                    ) * 1.2,
                2,
                '.'
            ),
            number_format(
                ($data->MasterPlywoodMDF->Harga_Plywood_MDF /
                    ($data->MasterPlywoodMDF->Panjang_Plywood_MDF
                        * $data->MasterPlywoodMDF->Lebar_Plywood_MDF / 1000000
                    ) * 1.2
                )
                    *
                    ($data->Panjang_Kebutuhan_Plywood_MDF_Item *
                        $data->Lebar_Kebutuhan_Plywood_MDF_Item / 1000000 *
                        $data->Quantity_Kebutuhan_Plywood_MDF_Item
                    ),
                2,
                '.'
            )
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
                    'bold' => true,
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

<?php

namespace App\Exports;

use App\Models\KebutuhanPendukungPackingItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KebutuhanPendukungPackingItemExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
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
        $data = KebutuhanPendukungPackingItem::with('Item', 'MasterPendukungPacking')
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
            'Keterangan',
            'Satuan',
            'Tebal',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Total M2',
            'Biaya Satuan',
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
            $data->Pendukung_Packing_Id,
            $data->MasterPendukungPacking->Nama_Pendukung_Packing,
            $data->Keterangan_Kebutuhan_Pendukung_Packing_Item,
            $data->MasterPendukungPacking->Satuan_Pendukung_Packing,
            $data->MasterPendukungPacking->Tebal_Pendukung_Packing,
            $data->Lebar_Kebutuhan_Pendukung_Packing_Item,
            $data->Panjang_Kebutuhan_Pendukung_Packing_Item,
            $data->Quantity_Kebutuhan_Pendukung_Packing_Item,
            ($data->MasterPendukungPacking->Satuan_Pendukung_Packing == "Meter")
                ? (number_format(
                    $data->Panjang_Kebutuhan_Pendukung_Packing_Item *
                        $data->Lebar_Kebutuhan_Pendukung_Packing_Item / 1000000 *
                        $data->Quantity_Kebutuhan_Pendukung_Packing_Item,
                    4,
                    '.'
                ))
                : '-',
            ($data->MasterPendukungPacking->Satuan_Pendukung_Packing == "Meter")
                ?  (' Rp' . number_format(
                    $data->MasterPendukungPacking->Harga_Pendukung_Packing /
                        ($data->MasterPendukungPacking->Panjang_Pendukung_Packing
                            * $data->MasterPendukungPacking->Lebar_Pendukung_Packing / 1000000
                        ),
                    2,
                    '.'
                ))
                : number_format($data->MasterPendukungPacking->Harga_Pendukung_Packing, 2, '.'),
            ($data->MasterPendukungPacking->Satuan_Pendukung_Packing == "Meter")
                ?  (' Rp' . number_format(
                    ($data->MasterPendukungPacking->Harga_Pendukung_Packing /
                        ($data->MasterPendukungPacking->Panjang_Pendukung_Packing
                            * $data->MasterPendukungPacking->Lebar_Pendukung_Packing / 1000000
                        )
                    )
                        *
                        ($data->Panjang_Kebutuhan_Pendukung_Packing_Item *
                            $data->Lebar_Kebutuhan_Pendukung_Packing_Item / 1000000 *
                            $data->Quantity_Kebutuhan_Pendukung_Packing_Item
                        ),
                    2,
                    '.'
                ))
                : number_format($data->MasterPendukungPacking->Harga_Pendukung_Packing * $data->Quantity_Kebutuhan_Pendukung_Packing_Item, 2, '.'),

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


        $sheet->getStyle('A1:O1')->applyFromArray($styleArray);
        $sheet->getStyle('A2:O' . ($sheet->getHighestRow()))->applyFromArray($styleArray);
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

<?php

namespace App\Exports;

use App\Models\KebutuhanKartonBoxPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKartonBoxPoExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $JobOrder;
    private $num = 1;

    public function __construct($JobOrder)
    {
        $this->JobOrder = $JobOrder;
    }

    public function collection()
    {
        $data = KebutuhanKartonBoxPo::where('Job_Order', $this->JobOrder)
            ->get();
        return $data;

    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Item',
            'No Cutting',
            'Material',
            'Keterangan',
            'Tinggi',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Qty Order',
            'Total Order',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Biaya' : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Total Biaya' : '',
        ];
    }

    public function map($data): array
    {
        $Jumlah = $data->Quantity_Kebutuhan_Karton_Box_Item;
        $Qty_Order = $data->Quantity_Purchase_Order;
        $Total_Order = $Jumlah * $Qty_Order ;
        $Harga = $data->Harga_Kebutuhan_Karton_Box_Item;
        $Total_Biaya = $Harga * $Total_Order;
        return [
            $this->num++,
            $data->Nama_Item,
            $data->No_Cutting,
            $data->Jenis_Kebutuhan_Karton_Box,
            $data->Keterangan_Kebutuhan_Karton_Box_Item,
            $data->Tinggi_Kebutuhan_Karton_Box_Item,
            $data->Lebar_Kebutuhan_Karton_Box_Item,
            $data->Panjang_Kebutuhan_Karton_Box_Item,
            $Jumlah,
            $Qty_Order,
            $Total_Order,
            (in_array(auth()->user()->akses , [1,2,3])) ? number_Format($Harga,2) : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? number_format($Total_Biaya,2) : ''
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
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A1:M1' : 'A1:K1')->applyFromArray($styleArray);
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A2:M' . $sheet->getHighestRow() : 'A2:K' . $sheet->getHighestRow())->applyFromArray($styleArray);
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

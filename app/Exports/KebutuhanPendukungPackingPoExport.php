<?php

namespace App\Exports;

use App\Models\KebutuhanPendukungPackingPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanPendukungPackingPoExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanPendukungPackingPo::where('Job_Order', $this->JobOrder)
            ->get();
        return $data;

    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Item',
            'No Cutting',
            'Kode Material',
            'Material',
            'Keterangan',
            'Satuan',
            'Tebal',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Qty Order',
            'Total Order',
            'Total Order M2',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Biaya' : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Total Biaya' : '',
        ];
    }

    public function map($data): array
    {
        $Jumlah = $data->Quantity_Kebutuhan_Pendukung_Packing_Item;
        $Qty_Order = $data->Quantity_Purchase_Order;
        $Total_Order = $Jumlah * $Qty_Order ;
        $Satuan = $data->Satuan_Pendukung_Packing;
        $Tebal = $data->Tebal_Pendukung_Packing;
        $Lebar = $data->Lebar_Kebutuhan_Pendukung_Packing_Item;
        $Panjang = $data->Panjang_Kebutuhan_Pendukung_Packing_Item;
        $Luas = $Lebar * $Panjang * $Total_Order /1000000;
        ($Satuan == "Meter") ? $Harga = $data->Harga_Pendukung_Packing / $data->Luas_Pendukung_Packing : $Harga = $data->Harga_Pendukung_Packing ;
        ($Satuan == "Meter") ? $Total_Biaya = $Harga * $Luas : $Total_Biaya = $Harga * $Total_Order;
        return [
            $this->num++,
            $data->Nama_Item,
            $data->No_Cutting,
            $data->Pendukung_Packing_Id,
            $data->Nama_Pendukung_Packing,
            $data->Keterangan_Kebutuhan_Pendukung_Packing_Item,
            $Satuan,
            $Tebal,
            $Lebar,
            $Panjang,
            $Jumlah,
            $Qty_Order,
            $Total_Order,
            $Luas,
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
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A1:P1' : 'A1:N1')->applyFromArray($styleArray);
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A2:P' . $sheet->getHighestRow() : 'A2:N' . $sheet->getHighestRow())->applyFromArray($styleArray);
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

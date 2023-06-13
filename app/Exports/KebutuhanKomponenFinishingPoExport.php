<?php

namespace App\Exports;

use App\Models\KebutuhanKomponenFinishingPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKomponenFinishingPoExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanKomponenFinishingPo::where('Job_Order', $this->JobOrder)
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
            'Satuan',
            'Jumlah',
            'Qty Order',
            'Total Order',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Biaya' : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Total Biaya' : '',
        ];
    }

    public function map($data): array
    {
        $Jumlah = $data->Quantity_Kebutuhan_Komponen_Finishing_Item;
        $Qty_Order = $data->Quantity_Purchase_Order;
        $Total_Order = $Jumlah * $Qty_Order ;
        $Harga = $data->Harga_Komponen_Finishing / $data->Quantity_Komponen_Finishing;
        $Total_Biaya = $Harga * $Total_Order;
        return [
            $this->num++,
            $data->Nama_Item,
            $data->No_Cutting,
            $data->Komponen_Finishing_Id,
            $data->Nama_Komponen_Finishing,
            $data->Satuan_Komponen_Finishing,
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
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A1:K1' : 'A1:I1')->applyFromArray($styleArray);
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A2:K' . $sheet->getHighestRow() : 'A2:I' . $sheet->getHighestRow())->applyFromArray($styleArray);
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

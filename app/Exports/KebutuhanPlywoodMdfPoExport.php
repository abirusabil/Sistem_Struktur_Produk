<?php

namespace App\Exports;

use App\Models\KebutuhanPlywoodMdfPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanPlywoodMdfPoExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanPlywoodMdfPo::where('Job_Order', $this->JobOrder)
            ->get();
        return $data;

    }

    public function headings(): array
    {
        return [
            'No',
            'Nama_Item',
            'No Cutting',
            'Kode Material',
            'Material',
            'KP',
            'Keterangan',
            'KWT',
            'Tebal',
            'Lebar',
            'Panjang',
            'Jumlah',
            'Qty Order',
            'Total Order',
            'Luas M2',
             
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Biaya /M2' : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Total Biaya' : '',
           
            

        ];
    }

    public function map($data): array
    {
        
        $tebal = $data->Tebal_Plywood_MDF;
        $Lebar = $data->Lebar_Kebutuhan_Plywood_MDF_Item;
        $Panjang = $data->Panjang_Kebutuhan_Plywood_MDF_Item;
        $Jumlah = $data->Quantity_Kebutuhan_Plywood_MDF_Item;
        $Qty_Order = $data->Quantity_Purchase_Order;
        $Total_Order = $Jumlah * $Qty_Order ;
        $Luas =  $Lebar * $Panjang / 1000000 * $Total_Order;
        $Harga = $data->Harga_Plywood_MDF / $data->Luas_Plywood_MDF *1.2 ;
        $Total_Biaya = $Harga * $Luas;
        return [
            $this->num++,
            $data->Nama_Item,
            $data->No_Cutting,
            $data->Plywood_MDF_Id,
            $data->Nama_Plywood_MDF,
            $data->KP_Kebutuhan_Plywood_MDF_Item,
            $data->Keterangan_Kebutuhan_Plywood_MDF_Item,
            $data->Grade_Kebutuhan_Plywood_MDF_Item,
            $tebal,
            $Lebar,
            $Panjang,
            $Jumlah,
            $Qty_Order,
            $Total_Order,
            number_format($Luas,4),
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
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A1:Q1' : 'A1:O1')->applyFromArray($styleArray);
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A2:Q' . $sheet->getHighestRow() : 'A2:O' . $sheet->getHighestRow())->applyFromArray($styleArray);
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

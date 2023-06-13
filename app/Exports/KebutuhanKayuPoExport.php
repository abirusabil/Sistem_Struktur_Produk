<?php

namespace App\Exports;

use App\Models\KebutuhanKayuPo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KebutuhanKayuPoExport implements FromCollection, WithHeadings ,WithMapping ,ShouldAutoSize ,WithStyles
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
        $data = KebutuhanKayuPo::where('Job_Order', $this->JobOrder)
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
            'Bruto TBL+5',
            'Bruto LBR+10%',
            'Bruto PNJG+5',
            'Netto Tebal',
            'Netto Lebar',
            'Netto Panjang',
            'Panjang Bruto',
            'Jumlah',
            'Qty Order',
            'Total Order',
            'Volume Bruto/M3',
             
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Biaya /M3' : '',
            (in_array(auth()->user()->akses , [1,2,3])) ? 'Total Biaya' : '',
           
            

        ];
    }

    public function map($data): array
    {
        
        $tebal = $data->Tebal_Kebutuhan_Kayu_Item;
        $Lebar = $data->Lebar_Kebutuhan_Kayu_Item;
        $Panjang = $data->Panjang_Kebutuhan_Kayu_Item;
        $Panjang_Bruto = $Panjang+20;
        $Bruto_Tebal = $tebal+5;
        $Bruto_Lebar = $Lebar+10;
        $Bruto_Panjang = $Panjang_Bruto * 1.1;
        $Jumlah =  $data->Quantity_Kebutuhan_Kayu_Item;
        $Qty_Order = $data->Quantity_Purchase_Order;
        $Total_Order = $Jumlah * $Qty_Order;
        $volume = $Bruto_Lebar * $Bruto_Panjang * $Bruto_Tebal /1000000000 * $Total_Order ;
        $Harga = $data->Harga_Kayu;
        $Total_Biaya= $Harga * $volume;
        return [
            $this->num++,
            $data->Nama_Item,
            $data->No_Cutting,
            $data->Kayu_Id,
            $data->Nama_Kayu,
            $data->KP_Kebutuhan_Kayu_Item,
            $data->Keterangan_Kebutuhan_Kayu_Item,
            $data->Grade_Kebutuhan_Kayu_Item,
            $Bruto_Tebal,
            $Bruto_Lebar,
            number_format($Bruto_Panjang,0),
            $tebal,
            $Lebar,
            $Panjang,
            $Panjang_Bruto,
            $Jumlah,
            $Qty_Order,
            $Total_Order,
            number_format($volume,4),
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
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A1:U1' : 'A1:S1')->applyFromArray($styleArray);
        $sheet->getStyle((in_array(auth()->user()->akses , [1,2,3])) ? 'A2:U' . $sheet->getHighestRow() : 'A2:S' . $sheet->getHighestRow())->applyFromArray($styleArray);
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

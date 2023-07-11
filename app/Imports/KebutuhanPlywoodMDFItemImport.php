<?php

namespace App\Imports;

use App\Models\KebutuhanPlywoodMDFItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanPlywoodMDFItemImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $itemId;
    public function __construct($itemId)
    {
        $this->itemId = $itemId;
    }
    public function model(array $row)
    {
        return new KebutuhanPlywoodMDFItem([
            // 'Item_Id' => $this->itemId,
            'id' => $row['kode_cutting'],
            'Item_Id' => $row['item_id'],
            'Plywood_MDF_Id' => $row['kode_material'],
            'KP_Kebutuhan_Plywood_MDF_Item' => $row['kp'],
            'Keterangan_Kebutuhan_Plywood_MDF_Item' => $row['keterangan'],
            'Grade_Kebutuhan_Plywood_MDF_Item' => $row['grade'],
            'Lebar_Kebutuhan_Plywood_MDF_Item' => $row['lebar'],
            'Panjang_Kebutuhan_Plywood_MDF_Item' => $row['panjang'],
            'Quantity_Kebutuhan_Plywood_MDF_Item' => $row['jumlah'],
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\KebutuhanPendukungPackingItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanPendukungPackingItemImport implements ToModel ,WithHeadingRow
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
        return new KebutuhanPendukungPackingItem([
            // 'Item_Id' => $this->itemId,
            'Item_Id' => $row['kode_item'],
            'id' => $row['kode_cutting'],
            'Pendukung_Packing_Id' => $row['kode_material'],
            'Keterangan_Kebutuhan_Pendukung_Packing_Item' => $row['keterangan'],
            'Lebar_Kebutuhan_Pendukung_Packing_Item' => $row['lebar'],
            'Panjang_Kebutuhan_Pendukung_Packing_Item' => $row['panjang'],
            'Quantity_Kebutuhan_Pendukung_Packing_Item' => $row['jumlah'],
        ]);
    }
}

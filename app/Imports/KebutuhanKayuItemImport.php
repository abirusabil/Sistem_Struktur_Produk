<?php

namespace App\Imports;

use App\Models\KebutuhanKayuItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanKayuItemImport implements ToModel ,WithHeadingRow
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
        return new KebutuhanKayuItem([
            // 'Item_Id' => $this->itemId,
            'id' => $row['kode_cutting'],
            'Item_Id' => $row['kode_item'],
            'Kayu_Id' => $row['kode_kayu'],
            'KP_Kebutuhan_Kayu_Item' => $row['kp'],
            'Keterangan_Kebutuhan_Kayu_Item' => $row['keterangan'],
            'Grade_Kebutuhan_Kayu_Item' => $row['grade'],
            'Tebal_Kebutuhan_Kayu_Item' => $row['tebal'],
            'Lebar_Kebutuhan_Kayu_Item' => $row['lebar'],
            'Panjang_Kebutuhan_Kayu_Item' => $row['panjang'],
            'Quantity_Kebutuhan_Kayu_Item' => $row['quantity'],
        ]);
    }
}

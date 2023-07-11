<?php

namespace App\Imports;

use App\Models\KebutuhanKomponenFinishingItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanKomponenFinishingItemImport implements ToModel, WithHeadingRow
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
        return new KebutuhanKomponenFinishingItem([
            // 'Item_Id' => $this->itemId,
            // 'id' => $row['id'],
            'id' => $row['kode_cutting'],
            'Item_Id' =>  $row['kode_item'],
            'Komponen_Finishing_Id' => $row['kode_komponen_finishing'],
            'Quantity_Kebutuhan_Komponen_Finishing_Item' => $row['quantity'],
        ]);
    }
}

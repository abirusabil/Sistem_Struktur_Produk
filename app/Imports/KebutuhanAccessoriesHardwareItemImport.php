<?php

namespace App\Imports;

use App\Models\KebutuhanAccessoriesHardwareItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanAccessoriesHardwareItemImport implements ToModel, WithHeadingRow
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
        return new KebutuhanAccessoriesHardwareItem([
            // 'Item_Id' => $this->itemId,
            'id' => $row['kode_cutting'],
            'Item_Id' => $row['kode_item'],
            'Accessories_Hardware_Id' => $row['kode_accessories_hardware'],
            'Keterangan_Kebutuhan_Accessories_Hardware_Item' => $row['keterangan'],
            'Quantity_Kebutuhan_Accessories_Hardware_Item' => $row['quantity'],
        ]);
    }
}

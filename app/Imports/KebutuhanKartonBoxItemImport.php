<?php

namespace App\Imports;

use App\Models\KebutuhanKartonBoxItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KebutuhanKartonBoxItemImport implements ToModel, WithHeadingRow
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
        return new KebutuhanKartonBoxItem([
            'id' => $row['kode_cutting'],
            'Item_Id' => $row['kode_item'],
            // 'Item_Id' => $this->itemId,
            'Jenis_Kebutuhan_Karton_Box' => $row['jenis'],
            'Keterangan_Kebutuhan_Karton_Box_Item' => $row['keterangan'],
            'Tinggi_Kebutuhan_Karton_Box_Item' => $row['tinggi'],
            'Lebar_Kebutuhan_Karton_Box_Item' => $row['lebar'],
            'Panjang_Kebutuhan_Karton_Box_Item' => $row['panjang'],
            'Harga_Kebutuhan_Karton_Box_Item' => $row['harga_satuan'],
            'Quantity_Kebutuhan_Karton_Box_Item' => $row['jumlah'],

        ]);
    }
}

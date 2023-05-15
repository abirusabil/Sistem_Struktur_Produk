<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            
            'id'=>$row['kode'],
            'Collection_Id'=>$row['collection'],
            'Nama_Item'=>$row['item'],
            'Tinggi_Item'=>$row['tinggi'],
            'Lebar_Item'=>$row['lebar'],
            'Panjang_Item'=>$row['panjang'],
            'Berat_Item'=>$row['berat'],
            'Warna_Item'=>$row['warna']
        ]);
    }
}

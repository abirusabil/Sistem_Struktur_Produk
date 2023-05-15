<?php

namespace App\Imports;

use App\Models\MasterKartonBox;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterKartonBoxImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterKartonBox([
            'id'=>$row['kode'],
            'Jenis_Karton_Box' => $row['karton_box'],
            'Satuan_Karton_Box' => $row['satuan'],
            'Harga_Karton_Box' => $row['harga'],
            'Suplier_Id' => $row['suplier'],
        ]);
    }
}

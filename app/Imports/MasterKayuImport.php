<?php

namespace App\Imports;

use App\Models\MasterKayu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterKayuImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterKayu([
            'id' => $row['kode'],
            'Nama_Kayu' => $row['kayu'],
            'Satuan' => $row['satuan'],
            'Harga_Kayu' => $row['harga'],
            'Suplier_Id' => $row['suplier']
            
        ]);
    }
}

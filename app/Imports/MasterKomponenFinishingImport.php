<?php

namespace App\Imports;

use App\Models\MasterKomponenFinishing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterKomponenFinishingImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterKomponenFinishing([
            'id'=>$row['kode'],
            'Nama_Komponen_Finishing' => $row['komponen_finishing'],
            'Quantity_Komponen_Finishing' => $row['quantity'],
            'Satuan_Komponen_Finishing' => $row['satuan'],
            'Harga_Komponen_Finishing' => $row['harga'],
            'Suplier_Id' => $row['suplier'],
        ]);
    }
}

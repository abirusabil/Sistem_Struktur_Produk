<?php

namespace App\Imports;

use App\Models\MasterPlywoodMdf;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterPlywoodMdfImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterPlywoodMdf([
            'id'=>$row['kode'],
            'Nama_Plywood_MDF'=>$row['nama'],
            'Tebal_Plywood_MDF'=>$row['tebal'],
            'Panjang_Plywood_MDF'=>$row['panjang'],
            'Lebar_Plywood_MDF'=>$row['lebar'],
            'Satuan_Plywood_MDF'=>$row['satuan'],
            'Harga_Plywood_MDF'=>$row['hargalembar'],
            'Suplier_Id'=>$row['suplier'],
        ]);
    }
}

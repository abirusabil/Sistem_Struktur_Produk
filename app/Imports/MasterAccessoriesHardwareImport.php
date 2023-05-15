<?php

namespace App\Imports;

use App\Models\MasterAccessoriesHardware;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterAccessoriesHardwareImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterAccessoriesHardware([
            'id'=>$row['kode'],
            'Nama_Accessories_Hardware' => $row['accessories_hardware'],
            'Ukuran_Accessories_Hardware' => $row['ukuran'],
            'Satuan_Accessories_Hardware' => $row['satuan'],
            'Harga_Accessories_Hardware' => $row['harga'],
            'Suplier_Id' => $row['suplier'],
        ]);
    }
}

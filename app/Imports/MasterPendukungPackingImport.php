<?php

namespace App\Imports;

use App\Models\MasterPendukungPacking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterPendukungPackingImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MasterPendukungPacking([
            'id' => $row['kode'],
            'Nama_Pendukung_Packing' => $row['pendukung_packing'],
            'Tebal_Pendukung_Packing' => $row['tebal'],
            'Panjang_Pendukung_Packing' => $row['panjang'],
            'Lebar_Pendukung_Packing' => $row['lebar'],
            'Satuan_Pendukung_Packing' => $row['satuan'],
            'Harga_Pendukung_Packing' => $row['harga_satuan'],
            'Suplier_Id' => $row['suplier'],
        ]);
    }
}

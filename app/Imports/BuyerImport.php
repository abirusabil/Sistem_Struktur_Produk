<?php

namespace App\Imports;

use App\Models\Buyer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BuyerImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buyer([
            'id'=>$row['kode'],
            'Nama_Buyer'=>$row['nama_buyer'],
            'Alamat_Buyer'=>$row['alamat'],
            'Kontak_Buyer'=>$row['kontak']
        ]);
    }
}

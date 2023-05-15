<?php

namespace App\Imports;

use App\Models\Suplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SuplierImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Suplier([
            'nama_suplier' => $row['nama_suplier'],
            'alamat_suplier' => $row['alamat_suplier'],
            'kontak_suplier' => $row['kontak_suplier']
        ]);
    }
}




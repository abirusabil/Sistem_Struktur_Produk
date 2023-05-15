<?php

namespace App\Imports;

use App\Models\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CollectionImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Collection([
           
            'id'=>$row['kode'],
            'Nama_Collection'=>$row['collection'],
            'Buyer_Id'=>$row['buyer']
        ]);
    }
}

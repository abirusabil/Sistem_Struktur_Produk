<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Suplier;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // Suplier::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'Sabil',
            'email' => 'sabil@mail.com',
            'password'=> Hash::make('abirusabil'),
            'akses'=>'1'
        ]);

        // \App\Models\Buyer::factory()->create([
        //     'id'=>'SW',
        //     'Nama_Buyer'=> 'Seawinds Trading Co',
        //     'Alamat_Buyer'=> '-',
        //     'Kontak_Buyer'=> '-'
        // ]);

        // \App\Models\Buyer::factory()->create([
        //     'id'=>'MX',
        //     'Nama_Buyer'=> 'Mecox',
        //     'Alamat_Buyer'=> '-',
        //     'Kontak_Buyer'=> '-'
        // ]);

        // \App\Models\Buyer::factory()->create([
        //     'id'=>'GB',
        //     'Nama_Buyer'=> 'Gabby',
        //     'Alamat_Buyer'=> '-',
        //     'Kontak_Buyer'=> '-'
        // ]);

        // \App\Models\Collection::factory()->create([
        //     'id'=>'MO',
        //     'Nama_Collection'=> 'Monaco Occasional',
        //     'Buyer_Id'=> 'SW'
        // ]);
        // \App\Models\Collection::factory()->create([
        //     'id'=>'CO',
        //     'Nama_Collection'=> 'Captiva Occasional',
        //     'Buyer_Id'=> 'SW'
        // ]);
        // \App\Models\Collection::factory()->create([
        //     'id'=>'KB',
        //     'Nama_Collection'=> 'KAUAI BEDROOM',
        //     'Buyer_Id'=> 'SW'
        // ]);
        // \App\Models\Collection::factory()->create([
        //     'id'=>'PR',
        //     'Nama_Collection'=> 'Port Royale',
        //     'Buyer_Id'=> 'SW'
        // ]);
        // \App\Models\Collection::factory()->create([
        //     'id'=>'SC',
        //     'Nama_Collection'=> 'Summer Classic',
        //     'Buyer_Id'=> 'GB'
        // ]);
        // \App\Models\Collection::factory()->create([
        //     'id'=>'MX',
        //     'Nama_Collection'=> 'Mecox',
        //     'Buyer_Id'=> 'MX'
        // ]);
        // \App\Models\Item::factory()->create([
        //     'id'=>'B53732-WHCRK',
        //     'Collection_Id'=>'CO',
        //     'Nama_Item'=>'ENTRY CABINET /W BASKET',
        //     'Tinggi_Item'=>'667',
        //     'Lebar_Item'=>'490',
        //     'Panjang_Item'=>'790',
        //     'Berat_Item'=>'400',
        //     'Warna_Item'=>'White Crackle Finish'
        // ]);
        // \App\Models\Item::factory()->create([
        //     'id'=>'B53737-WHCRK',
        //     'Collection_Id'=>'KB',
        //     'Nama_Item'=>'Kauai 7-Drawer Dresser',
        //     'Tinggi_Item'=>'1566',
        //     'Lebar_Item'=>'526',
        //     'Panjang_Item'=>'1007',
        //     'Berat_Item'=>'400',
        //     'Warna_Item'=>'White Crackle Finish'
        // ]);
        // \App\Models\Item::factory()->create([
        //     'id'=>'B53739-GREY',
        //     'Collection_Id'=>'KB',
        //     'Nama_Item'=>'Kauai Twin Headboard with Grey Kubu Weave',
        //     'Tinggi_Item'=>'1142',
        //     'Lebar_Item'=>'90',
        //     'Panjang_Item'=>'837',
        //     'Berat_Item'=>'400',
        //     'Warna_Item'=>'Grey Kubu Finish'
        // ]);
        // \App\Models\Item::factory()->create([
        //     'id'=>'B53740-GREY',
        //     'Collection_Id'=>'KB',
        //     'Nama_Item'=>'Kauai Queen Headboard with Grey Kubu Weave',
        //     'Tinggi_Item'=>'1675',
        //     'Lebar_Item'=>'90',
        //     'Panjang_Item'=>'837',
        //     'Berat_Item'=>'400',
        //     'Warna_Item'=>'Grey Kubu Finish'
        // ]);
        // \App\Models\MasterKayu::factory()->create([
        //     'id'=>'MHN',
        //     'Nama_Kayu'=>'Mahony',
        //     'Satuan'=>'M3',
        //     'Harga_Kayu'=>'7000000',
        //     'Suplier_Id'=>'2'
        // ]);
        // \App\Models\MasterKayu::factory()->create([
        //     'id'=>'MND',
        //     'Nama_Kayu'=>'Mindi',
        //     'Satuan'=>'M3',
        //     'Harga_Kayu'=>'6000000',
        //     'Suplier_Id'=>'4'
        // ]);
        // \App\Models\MasterKayu::factory()->create([
        //     'id'=>'JTI',
        //     'Nama_Kayu'=>'Jati',
        //     'Satuan'=>'M3',
        //     'Harga_Kayu'=>'11000000',
        //     'Suplier_Id'=>'3'
        // ]);
        // \App\Models\MasterAccessoriesHardware::factory()->create([
        //     'id'=>'HK38',
        //     'Nama_Accessories_Hardware' => 'Handle Knob',
        //     'Ukuran_Accessories_Hardware' => 'D 38',
        //     'Satuan_Accessories_Hardware' => 'Pcs',
        //     'Harga_Accessories_Hardware' => '3000',
        //     'Suplier_Id' => '1',
        // ]);
        // \App\Models\MasterAccessoriesHardware::factory()->create([
        //     'id'=>'MNM4',
        //     'Nama_Accessories_Hardware' => 'Mur Nanas',
        //     'Ukuran_Accessories_Hardware' => 'M4',
        //     'Satuan_Accessories_Hardware' => 'Pcs',
        //     'Harga_Accessories_Hardware' => '400',
        //     'Suplier_Id' => '1',
        // ]);
        // \App\Models\MasterAccessoriesHardware::factory()->create([
        //     'id'=>'MN6',
        //     'Nama_Accessories_Hardware' => 'Mur Nanas',
        //     'Ukuran_Accessories_Hardware' => '6 x 20',
        //     'Satuan_Accessories_Hardware' => 'Pcs',
        //     'Harga_Accessories_Hardware' => '3000',
        //     'Suplier_Id' => '1',
        // ]);
        // \App\Models\MasterAccessoriesHardware::factory()->create([
        //     'id'=>'PRD5',
        //     'Nama_Accessories_Hardware' => 'Plat Ring',
        //     'Ukuran_Accessories_Hardware' => 'Diameter 5',
        //     'Satuan_Accessories_Hardware' => 'Pcs',
        //     'Harga_Accessories_Hardware' => '57.50',
        //     'Suplier_Id' => '1',
        // ]);
        // \App\Models\MasterAccessoriesHardware::factory()->create([
        //     'id'=>'BJT435',
        //     'Nama_Accessories_Hardware' => 'Baut JT',
        //     'Ukuran_Accessories_Hardware' => '4 x 35',
        //     'Satuan_Accessories_Hardware' => 'Pcs',
        //     'Harga_Accessories_Hardware' => '142',
        //     'Suplier_Id' => '1',
        // ]);
    }
}

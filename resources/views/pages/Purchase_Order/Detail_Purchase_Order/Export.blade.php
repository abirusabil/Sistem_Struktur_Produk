<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
    #table-1 {
    border-collapse: collapse;
    width: 100%;
    text-align: center;
    border: 1px solid black;
    }
    h1{
        font-size: 50px;
        text-align: center;
        margin-bottom: 0px;
        margin-top: 10px;
    }
    hr{
        border: 2px solid;
    }
    .text-left{
        text-align: left
    }
    #table-1 td,
    #table-1 th {
    border: 1px solid black;
    padding: 8px;
    }
    h3 , p {
    margin: 5px;
    }

    table.header {
    width: 100%;
    padding: 10px;
    font-size: 17px;
    line-height: 25px;
    font-weight: bold;
    }
    body{
        padding: 0px 20px;
    }
    

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>PURCHASE ORDER </h1>
                <hr>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block pb-0">
                                <div class="row">
                                    <div class="col-lg">
                                        <table class="header">
                                            <tr>
                                                <td>
                                                    <p>Dasar Po : {{ $Purchase_Order->Dasar_Po }}
                                                    <br>
                                                    JO : {{ $Purchase_Order->id }}</p>  
                                                </td>
                                                <td>
                                                    <p>
                                                        Tgl OP Masuk : <br>
                                                        {{ $tanggal_masuk  }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                            </div>
                            <div class="card-body mt-0 pt-0">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                                <table class="table-striped table" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center border">
                                                                #
                                                            </th>
                                                            <th class="border">Item</th>
                                                            <th class="border">Code</th>
                                                            <th class="border">Qty</th>
                                                            <th class="border" colspan="2">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($detailPurchaseOrders as $detailPurchaseOrder => $items) 
                                                            <tr class="border text-left">
                                                                <td colspan="6">
                                                                    <h3>{{ $detailPurchaseOrder }}</h3>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $totalQuantity = 0;
                                                            @endphp
                                                        @foreach ($items as $item)
                                                            <tr>
                                                                <td class="border">
                                                                    <p class="text-center">{{ $loop->iteration }}</p>
                                                                </td>
                                                                <td class="border w-25 text-left">
                                                                    <p >{{ $item->Item->Nama_Item }}</p>
                                                                </td>
                                                                <td class="border">
                                                                    <p class="text-center">{{ $item->Item_Id }}</p>
                                                                </td>
                                                                <td class="border">
                                                                    <p class="text-center">{{ number_format($item->Quantity_Purchase_Order) }}</p>
                                                                </td>
                                                                <td class="border text-left" colspan="2">
                                                                    <p class="mb-0">Dimension :<br>
                                                                        {{ number_format($item->Item->Tinggi_Item ) }} X 
                                                                        {{ number_format($item->Item->Lebar_Item ) }} X 
                                                                        {{ number_format($item->Item->Panjang_Item ) }} 
                                                                    </p>
                                                                    <p>Colour : <br>
                                                                        {{ $item->Item->Warna_Item  }}
                                                                    </p>
                                                                </td>        
                                                            </tr>
                                                            @php
                                                                $totalQuantity += $item->Quantity_Purchase_Order;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td class="text-center border " colspan="3">
                                                                <h3>Total Item</h3>
                                                            </td>
                                                            <td class="border">
                                                                <h3 class="text-center">{{ $totalQuantity }}</h3>
                                                            </td>
                                                            <td class="border" colspan="2"></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <h1>Schedule Kirim : {{ $schedule_kirim }}</h1>

                                                <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
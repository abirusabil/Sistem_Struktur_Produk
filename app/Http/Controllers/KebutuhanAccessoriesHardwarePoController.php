<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanAccessoriesHardwarePo;
use Illuminate\Http\Request;

class KebutuhanAccessoriesHardwarePoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanAccessoriesHardwarePo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Accessories_Hardware.List_Kebutuhan_Accessories_Hardware',[
            'type_menu'=>'Accessories_Hardware',
            'KebutuhanAccessoriesHardware'=> KebutuhanAccessoriesHardwarePo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }
}

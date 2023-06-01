<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanPendukungPackingPo;
use Illuminate\Http\Request;

class KebutuhanPendukungPackingPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanPendukungPackingPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Pendukung_Packing.List_Kebutuhan_Pendukung_Packing',[
            'type_menu'=>'Pendukung_Packing',
            'KebutuhanPendukungPacking'=>KebutuhanPendukungPackingPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanKomponenFinishingPo;
use Illuminate\Http\Request;

class KebutuhanKomponenFinishingPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanKomponenFinishingPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Komponen_Finishing.List_Kebutuhan_Komponen_finishing' , 
        [
            'type_menu'=>'Komponen_Finishing',
            'KebutuhanKomponenFinishing'=>KebutuhanKomponenFinishingPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }
}

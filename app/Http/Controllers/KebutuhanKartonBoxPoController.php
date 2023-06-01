<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanKartonBoxPo;
use Illuminate\Http\Request;

class KebutuhanKartonBoxPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    return KebutuhanKartonBoxPo::with('PurchaseOrder')->get();
       return view('pages.Data-Materials.Karton_Box.List_Kebutuhan_Karton_Box',
       [
        'type_menu'=>'Karton_Box',
        'KebutuhanKartonBox'=>KebutuhanKartonBoxPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }
}

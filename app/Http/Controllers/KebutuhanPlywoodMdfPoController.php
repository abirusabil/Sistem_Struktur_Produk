<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanPlywoodMdfPo;
use Illuminate\Http\Request;

class KebutuhanPlywoodMdfPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanPlywoodMdfPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Plywood_MDF.List_Kebutuhan_Plywood_Mdf',
            [
                "type_menu" => "Plywood_MDF" ,
                // 'KebutuhanPlywoodMdf' => KebutuhanPlywoodMdfPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40),
                'KebutuhanPlywoodMdf' => KebutuhanPlywoodMdfPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
                
                // 'Suplier'=>Suplier::all()
            ]
        );
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
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }
}

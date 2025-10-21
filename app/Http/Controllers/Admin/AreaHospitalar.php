<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FarmaciaAreaHospitalar;

class AreaHospitalar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmaciaId = '11a2d86a-c885-44e4-9162-14215ef75b95';

        $areas = FarmaciaAreaHospitalar::with('area_hospitalar')
            ->where('farmacia_id', $farmaciaId)
            ->orderByDesc('id')
            ->get();

        return view('admin::area_hospitalar.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Http\Requests\StorePelajaranRequest;
use App\Http\Requests\UpdatePelajaranRequest;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelajarans = Pelajaran::all();
        return view('admin.pelajaran.index',[
            'pelajarans' => $pelajarans
        ]);
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
    public function store(StorePelajaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelajaran $pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelajaran $pelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelajaranRequest $request, Pelajaran $pelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelajaran $pelajaran)
    {
        //
    }
}

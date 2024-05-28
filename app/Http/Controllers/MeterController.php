<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeterRequest;
use App\Http\Requests\UpdateMeterRequest;
use App\Http\Resources\MeterResource;
use App\Models\Meter;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meters = Meter::with('customer')->get();
        return MeterResource::collection($meters);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeterRequest $request)
    {
        $meter = Meter::create($request->validated());
        return new MeterResource($meter);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meter $meter)
    {
        return new MeterResource($meter);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meter $meter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeterRequest $request, Meter $meter)
    {
        $meter->update($request->validated());
        return new MeterResource($meter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meter $meter)
    {
        $meter->delete();
        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeterReadingRequest;
use App\Http\Requests\UpdateMeterReadingRequest;
use App\Models\MeterReading;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meterReadings = MeterReading::all();
        return MeterReadingResource::collection($meterReadings);
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
     * 
     * @param  \App\Http\Requests\StoreMeterReadingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeterReadingRequest $request)
    {
        $meterReading = MeterReading::create($request->validated());
        return new MeterReadingResource($meterReading);
    }

    /**
     * Display the specified resource.
     */
    public function show(MeterReading $meterReading)
    {
        return new MeterReadingResource($meterReading);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeterReading $meterReading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeterReadingRequest $request, MeterReading $meterReading)
    {
        $meterReading->update($request->validated());
        return new MeterReadingResource($meterReading);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeterReading $meterReading)
    {
        $meterReading->delete();
        return response()->noContent();
    }
}

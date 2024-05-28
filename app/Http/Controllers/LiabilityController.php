<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiabilityRequest;
use App\Http\Requests\UpdateLiabilityRequest;
use App\Http\Resources\LiabilityResource;
use App\Models\Liability;
use Illuminate\Http\Request;

class LiabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liabilities = Liability::all();
        return LiabilityResource::collection($liabilities);
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
    public function store(StoreLiabilityRequest $request)
    {
        $liability = Liability::create($request->validated());
        return new LiabilityResource($liability);
    }

    /**
     * Display the specified resource.
     */
    public function show(Liability $liability)
    {
        return new LiabilityResource($liability);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liability $liability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiabilityRequest $request, Liability $liability)
    {
        $liability->update($request->validated());
        return new LiabilityResource($liability);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liability $liability)
    {
        $liability->delete();
        return response()->noContent();
    }
}

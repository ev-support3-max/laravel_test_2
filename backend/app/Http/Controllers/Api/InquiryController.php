<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 全権取得して返す
        return Inquiry::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInquiryRequest $request)
    {
        $validated = Inquiry::create($request->validated());

        return response()->json([
            'message' => 'Inquiry posted successfully',
            'data' => $validated,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inquiry::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInquiryRequest $request, string $id)
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

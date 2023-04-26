<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'reportable_type' => 'required|string',
            'reportable_id' => 'required|integer',
            'report_type_id' => 'required|integer|exists:report_types,id',
            'description' => 'nullable|string',
        ]);

        // If validation fails, return a JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'icon' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create a new report using the validated data
        $report = new Report([
            'reportable_type' => $request->input('reportable_type'),
            'reportable_id' => $request->input('reportable_id'),
            'user_id' => auth()->id(),
            'report_type_id' => $request->input('report_type_id'),
            'description' => $request->input('description'),
        ]);

        // Save the report to the database
        $report->save();

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'Report created successfully',
            'icon' => 'success',
            'data' => $report,
        ]);
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

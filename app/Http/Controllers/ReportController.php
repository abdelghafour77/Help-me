<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::get();
        // dd($reports);
        return view('reports', compact('reports'));
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
        // dd($request->all());
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'reportable_type' => 'required|string',
            'reportable_id' => 'required|integer',
            'report_type_id' => 'required|integer|exists:report_types,id',
            'description' => 'nullable|string',
            'question_id' => 'nullable|integer|exists:questions,id',

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
            'question_id' => $request->input('question_id'),
            'reported_at' => now(),
            'is_resolved' => false,
            'resolved_at' => null,
            'resolved_by' => null,
            'resolution' => null,
            'report_type_id' => $request->input('report_type_id'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),

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
        $report = Report::with('reportType', 'user', 'question')->findOrFail($id);
        // role of the user that created the report
        $report->user->role = $report->user->roles()->first()->name;

        // return json response
        return response()->json([
            'message' => 'Report fetched successfully',
            'icon' => 'success',
            'data' => $report,
        ]);
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

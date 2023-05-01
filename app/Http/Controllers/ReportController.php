<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view reports')) {
                $reports = Report::get();
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed reports", "GET", request()->ip());
                return view('reports', compact('reports'));
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view reports", "GET", request()->ip());
                session()->flash('message', 'You are not allowed to view reports');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to view reports", "GET", request()->ip());
            session()->flash('message', 'You must be logged in to view reports');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
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
        if (auth()->user()) {
            $log = new LogController();
            if (auth()->user()->hasPermissionTo('create report')) {
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
                    $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to create a report", "POST", request()->ip());
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
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " created a report", "POST", request()->ip());
                // Return a JSON response indicating success
                return response()->json([
                    'message' => 'Report created successfully',
                    'icon' => 'success',
                    'data' => $report,
                ]);
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to create a report", "POST", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to report',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "Guest tried to create a report", "POST", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to report',
                'icon' => 'error',
            ], 401);
        }
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
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view reports')) {

                $report = Report::with('reportType', 'user', 'question')->findOrFail($id);
                $report->user->role = $report->user->roles()->first()->name;
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed report ID: " . $report->id, "GET", request()->ip());
                return response()->json([
                    'message' => 'Report fetched successfully',
                    'icon' => 'success',
                    'data' => $report,
                ]);
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view report ID: " . $id, "GET", request()->ip());
                return response()->json([
                    'message' => 'You are not allowed to view reports',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            $log->logMe("warning", "Guest tried to view report ID: " . $id, "GET", request()->ip());
            return response()->json([
                'message' => 'You must be logged in to view reports',
                'icon' => 'error',
            ], 401);
        }
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

<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Http\Requests\TimesheetRequest;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $timesheets = Timesheet::all();
            return response()->json($timesheets, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve timesheets'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TimesheetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimesheetRequest $request)
    {
        try {
            $timesheet = Timesheet::create($request->validated());
            return response()->json($timesheet, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create timesheet'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $timesheet = Timesheet::findOrFail($id);
            return response()->json($timesheet, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Timesheet not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TimesheetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimesheetRequest $request, $id)
    {
        try {
            $timesheet = Timesheet::findOrFail($id);
            $timesheet->update($request->validated());
            return response()->json($timesheet, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update timesheet'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $timesheet = Timesheet::findOrFail($id);
            $timesheet->delete();
            return response()->json(['message' => 'Timesheet deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete timesheet'], 500);
        }
    }
}

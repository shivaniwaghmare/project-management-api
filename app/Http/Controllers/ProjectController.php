<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Handle standard field filters (e.g., project name, status)
        if ($request->has('filters')) {
            foreach ($request->get('filters') as $field => $value) {
                // Check if value is an array (for operators)
                if (is_array($value)) {
                    foreach ($value as $operator => $val) {
                        if (in_array($operator, ['=', '>', '<', '>=', '<=', 'LIKE'])) {
                            $query->where($field, $operator, $val);
                        }
                    }
                } else {
                    // Default operator is '='
                    $query->where($field, '=', $value);
                }
            }
        }

        // Handle EAV attribute filters
        if ($request->has('filters')) {
            foreach ($request->get('filters') as $field => $value) {
                $attribute = Attribute::where('name', $field)->first();
                if ($attribute) {
                    $query->whereHas('attributes', function ($q) use ($attribute, $value) {
                        if (is_array($value)) {
                            foreach ($value as $operator => $val) {
                                if (in_array($operator, ['=', '>', '<', '>=', '<=', 'LIKE'])) {
                                    $q->where('attribute_id', $attribute->id)
                                      ->where('value', $operator, $val);
                                }
                            }
                        } else {
                            $q->where('attribute_id', $attribute->id)
                              ->where('value', '=', $value);
                        }
                    });
                }
            }
        }

        // Include related attributes and paginate
        $projects = $query->with('attributes.attribute')->paginate(10);

        return response()->json($projects);
    }
    
    public function show($id)
    {
        return Project::with('attributes.attribute')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:active,inactive,completed'
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}

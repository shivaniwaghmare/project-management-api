<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Attribute;

class ProjectController extends Controller
{
    public function index(ProjectRequest $request)
    {
        $query = Project::query();

        // Handle standard field filters
        if ($request->has('filters')) {
            foreach ($request->get('filters') as $field => $value) {
                if (is_array($value)) {
                    foreach ($value as $operator => $val) {
                        if (in_array($operator, ['=', '>', '<', '>=', '<=', 'LIKE'])) {
                            $query->where($field, $operator, $val);
                        }
                    }
                } else {
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

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    public function update(ProjectRequest $request, $id)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectAttributeController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'attributes' => 'required|array',
            'attributes.*.id' => 'exists:attributes,id',
            'attributes.*.value' => 'required'
        ]);

        $project = Project::findOrFail($projectId);

        foreach ($request->attributes as $attribute) {
            AttributeValue::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'attribute_id' => $attribute['id']
                ],
                ['value' => $attribute['value']]
            );
        }

        return response()->json(['message' => 'Attributes updated successfully']);
    }

    public function show($projectId)
    {
        $project = Project::with('attributes.attribute')->findOrFail($projectId);
        return $project;
    }
}

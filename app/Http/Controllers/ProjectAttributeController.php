<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectAttributeRequest;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectAttributeController extends Controller
{
    public function store(StoreProjectAttributeRequest $request, $projectId)
    {
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

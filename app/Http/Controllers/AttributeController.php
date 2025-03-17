<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }

    public function store(StoreAttributeRequest $request)
    {
        return Attribute::create($request->validated());
    }
}

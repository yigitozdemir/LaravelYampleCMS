<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get all property definitions at once
     * @param Request $request
     * 
     * @return [type]
     */
    public function getDocTypeDefinitions(Request $request)
    {
        return response()->json(DocType::all());
    }

    public function getDocTypeDefinition(Request $request, $id)
    {
        
    }
}

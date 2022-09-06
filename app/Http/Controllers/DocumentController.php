<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Creates document initial metadata on documents table
     * @param Request $request
     * 
     * @return JSON response
     */
    public function createDocumentWithoutFile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'doc_type_id' => 'required|integer'
        ], [
            'name.required' => 'Document title is required',
            'name.max' => 'Document title can not be longer then 255 characters',
            'description.max' => 'Document description can not be longer then 255 characters',
            'doc_type_id.integer' => 'Doc type must be an integer',
            'doc_type_id.required' => 'Doc type is required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'result' => 'FAIL',
                'reason' => $validate->errors(),
            ]);
        }

        try{
            $document = Document::create([
                'doc_name' => $request->input('name'),
                'doc_description' => $request->input('description'),
                'document_type' => $request->input('doc_type_id'),
            ]);

            if($document){
                return response()->json(
                    [
                        'result' => 'SUCCESS',
                        'reason' => 'ok',
                        'created' => $document,
                    ]
                );
            }
        }
        catch(\Exception $e){
            return response()->json([
                'result' => 'FAIL',
                'reason' => 'DB_ERROR',
                'detail' => $e
            ]);
        }
    }

    public function uploadFile(Request $request, $docId)
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DocPropertyMap;
use App\Models\DocType;
use App\Models\Document;
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

    /**
     * Get one document type definition by its ID
     * @param Request $request
     * @param mixed $id
     * 
     * @return [type]
     */
    public function getDocTypeDefinition(Request $request, $id)
    {
        return response()->json(DocType::find($id));
    }

    /**
     * Create a document type definition
     * This does not creates mapping
     * @param Request $request
     * 
     * @return [type]
     */
    public function createDocTypeDefinition(Request $request)
    {
        $docTypeName = $request->input('name');
        $docTypeDescription = $request->input('description');

        // if property name has not been sent
        if ($docTypeName == null || $docTypeName == "") {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME'
                ]
            );
        }

        try {
            $docType = DocType::create(
                [
                    'doc_type_name' => $docTypeName,
                    'doc_type_description' => $docTypeDescription,
                ]
            );

            if ($docType) {
                return response()->json(
                    [
                        'result' => 'SUCCESS',
                        'reason' => 'ok',
                        'created' => $docType,
                    ]
                );
            }
        } catch (\Exception $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json(
                    [
                        'result' => 'FAIL',
                        'reason' => 'DUPLICATE_ENTRY'
                    ]
                );
            }
        }
    }

    /**
     * Update a DocType's name
     * @param Request $request
     * @param mixed $id
     * 
     * @return [type]
     */
    public function updateName(Request $request, $id)
    {
        if ($request->input('name') == null || $request->input('name') == '') {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME'
                ]
            );
        }

        $docType = DocType::find($id);
        $docType->doc_type_name = $request->input('name');
        try {
            $docType->save();
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'created' => $docType,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME',
                    'detail' => $e
                ]
            );
        }
    }

    /**
     * Update a Doctype's description
     * @param Request $request
     * @param mixed $id
     * 
     * @return [type]
     */
    public function updateDescription(Request $request, $id)
    {
        $docType = DocType::find($id);
        $docType->doc_type_description = $request->input('description');

        try {
            $docType->save();
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'created' => $docType,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DB_ERROR',
                    'detail' => $e
                ]
            );
        }
    }


    /**
     * Delete a document type definition
     * @param Request $request
     * @param mixed $id
     * 
     * @return [type]
     */
    public function deleteDocType(Request $request, $id)
    {
        $docType = null;
        try {
            $docType = DocType::find($id);
            if($docType == null) {
                return response()->json(
                    [
                        'result' => 'FAIL',
                        'reason' => 'NOT_FOUND',
                    ]
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'NOT_FOUND',
                    'detail' => $e
                ]
            );
        }

        //if document type is used in a document, fail
        if (Document::where('document_type', '=', $id)->limit(1)->count() > 0) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DOCTYPE_IN_USE',
                ]
            );
        }

        try {
            //delete doc-prop mappings first
            DocPropertyMap::where('doc_type_id', '=', $id)->delete();
            $docType->delete();
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DATABASE_ERROR',
                    'detail' => $e
                ]
            );
        }
    }
}
